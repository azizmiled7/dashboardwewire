<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    /**
     * Page principale du chat
     * GET /contact?with={user_id}
     */
    public function index(Request $request)
    {
        // Mettre à jour last_seen de l'utilisateur connecté
        auth()->user()->update(['last_seen' => now()]);

        // Liste de tous les autres utilisateurs
        $users = User::where('id', '!=', auth()->id())->get();

        // Utilisateur sélectionné pour la conversation
        $selectedUser = null;
        $messages = collect();

        if ($request->has('with')) {
            $selectedUser = User::findOrFail($request->with);

            // Charger la conversation entre les deux
            $messages = Message::where(function ($q) use ($selectedUser) {
                    $q->where('sender_id', auth()->id())
                      ->where('receiver_id', $selectedUser->id);
                })
                ->orWhere(function ($q) use ($selectedUser) {
                    $q->where('sender_id', $selectedUser->id)
                      ->where('receiver_id', auth()->id());
                })
                ->orderBy('created_at', 'asc')
                ->get();

            // Marquer les messages reçus comme lus
            Message::where('sender_id', $selectedUser->id)
                ->where('receiver_id', auth()->id())
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return view('contact', compact('users', 'selectedUser', 'messages'));
    }

    /**
     * Envoyer un message
     * POST /contact/send
     */
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body'        => 'nullable|string|max:2000',
            'attachment'  => 'nullable|file|max:5120', // 5MB max
        ]);

        // Au moins un des deux (texte ou fichier) est requis
        if (!$request->body && !$request->hasFile('attachment')) {
            return back()->withErrors(['body' => 'Écris un message ou joint un fichier.']);
        }

        // Mettre à jour last_seen
        auth()->user()->update(['last_seen' => now()]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('chat_attachments', 'public');
        }

        Message::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'body'        => $request->body,
            'attachment'  => $attachmentPath,
            'is_read'     => false,
        ]);

        return redirect()->route('contact', ['with' => $request->receiver_id]);
    }

    /**
     * Polling AJAX : récupère les nouveaux messages depuis un ID donné
     * GET /contact/poll?with={user_id}&last_id={last_message_id}
     */
    public function poll(Request $request)
    {
        // Mettre à jour last_seen
        auth()->user()->update(['last_seen' => now()]);

        $selectedUserId = $request->with;
        $lastId = (int) $request->get('last_id', 0);

        $messages = Message::where('id', '>', $lastId)
            ->where(function ($q) use ($selectedUserId) {
                $q->where(function ($q2) use ($selectedUserId) {
                    $q2->where('sender_id', auth()->id())
                       ->where('receiver_id', $selectedUserId);
                })->orWhere(function ($q2) use ($selectedUserId) {
                    $q2->where('sender_id', $selectedUserId)
                       ->where('receiver_id', auth()->id());
                });
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($m) {
                return [
                    'id'          => $m->id,
                    'sender_id'   => $m->sender_id,
                    'sender_name' => $m->sender->name,
                    'body'        => $m->body,
                    'attachment'  => $m->attachment ? asset('storage/' . $m->attachment) : null,
                    'created_at'  => $m->created_at->format('H:i d/m/Y'),
                    'is_mine'     => $m->sender_id === auth()->id(),
                ];
            });

        // Marquer comme lus
        Message::where('sender_id', $selectedUserId)
            ->where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Statut en ligne des utilisateurs
        $onlineStatus = User::where('id', '!=', auth()->id())
            ->get()
            ->mapWithKeys(fn($u) => [$u->id => $u->isOnline()]);

        return response()->json([
            'messages'      => $messages,
            'online_status' => $onlineStatus,
        ]);
    }

    /**
     * Nombre de messages non lus (pour badge dans le menu)
     * GET /contact/unread-count
     */
    public function unreadCount()
    {
        $count = Message::where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }
}
