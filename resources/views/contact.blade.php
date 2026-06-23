@extends('theme')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18" style="color:rgb(90,84,84)">Contact</h4>
            </div>
        </div>
    </div>

    <div class="row" style="height:calc(100vh - 220px); min-height:500px;">

        {{-- ===== COLONNE GAUCHE : liste des utilisateurs ===== --}}
        <div class="col-md-3 col-lg-2 pe-0">
            <div class="card h-100 mb-0">
                <div class="card-body p-2">
                    <ul class="list-unstyled mb-0" id="user-list">
                        @foreach($users as $u)
                            <li>
                                <a href="{{ route('contact', ['with' => $u->id]) }}"
                                   class="d-flex align-items-center justify-content-between px-2 py-2 rounded
                                          {{ isset($selectedUser) && $selectedUser->id === $u->id ? 'bg-light fw-bold' : '' }}"
                                   style="text-decoration:none;color:#333;">
                                    <span>{{ $u->name }}</span>
                                    <span class="online-dot"
                                          data-user-id="{{ $u->id }}"
                                          style="
                                            width:10px;height:10px;border-radius:50%;display:inline-block;
                                            background:{{ $u->isOnline() ? '#34c38f' : '#ccc' }};
                                          ">
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- ===== COLONNE DROITE : fenêtre de chat ===== --}}
        <div class="col-md-9 col-lg-10 ps-0">
            <div class="card h-100 mb-0 d-flex flex-column">

                @if($selectedUser)
                    {{-- Header conversation --}}
                    <div class="card-header d-flex align-items-center gap-2 py-2" style="border-bottom:1px solid #eee;">
                        <span class="online-dot"
                              data-user-id="{{ $selectedUser->id }}"
                              style="
                                width:12px;height:12px;border-radius:50%;display:inline-block;
                                background:{{ $selectedUser->isOnline() ? '#34c38f' : '#ccc' }};
                              ">
                        </span>
                        <strong>{{ $selectedUser->name }}</strong>
                        <small class="text-muted ms-1">
                            {{ $selectedUser->isOnline() ? 'En ligne' : 'Hors ligne' }}
                        </small>
                    </div>

                    {{-- Zone des messages --}}
                    <div class="card-body flex-grow-1 overflow-auto p-3" id="chat-box" style="max-height:420px;">
                        @foreach($messages as $msg)
                            @if($msg->sender_id === auth()->id())
                                {{-- Message envoyé (droite, bleu) --}}
                                <div class="d-flex justify-content-end mb-2">
                                    <div style="
                                        background:#5b73e8;color:#fff;
                                        border-radius:12px 12px 0 12px;
                                        padding:8px 14px;
                                        max-width:60%;
                                    ">
                                        <div style="font-size:11px;font-weight:600;margin-bottom:3px;">
                                            {{ auth()->user()->name }}
                                        </div>
                                        @if($msg->body)
                                            <div>{{ $msg->body }}</div>
                                        @endif
                                        @if($msg->attachment)
                                            @php $ext = pathinfo($msg->attachment, PATHINFO_EXTENSION); @endphp
                                            @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif','webp']))
                                                <img src="{{ asset('storage/'.$msg->attachment) }}"
                                                     style="max-width:200px;max-height:200px;border-radius:8px;margin-top:4px;"
                                                     alt="image">
                                            @else
                                                <a href="{{ asset('storage/'.$msg->attachment) }}"
                                                   target="_blank"
                                                   style="color:#fff;text-decoration:underline;">
                                                    📎 Fichier joint
                                                </a>
                                            @endif
                                        @endif
                                        <div style="font-size:10px;opacity:.75;text-align:right;margin-top:3px;">
                                            {{ $msg->created_at->format('H:i d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Message reçu (gauche, gris clair) --}}
                                <div class="d-flex justify-content-start mb-2">
                                    <div style="
                                        background:#f1f3f7;color:#333;
                                        border-radius:12px 12px 12px 0;
                                        padding:8px 14px;
                                        max-width:60%;
                                    ">
                                        <div style="font-size:11px;font-weight:600;margin-bottom:3px;color:#5b73e8;">
                                            {{ $msg->sender->name }}
                                        </div>
                                        @if($msg->body)
                                            <div>{{ $msg->body }}</div>
                                        @endif
                                        @if($msg->attachment)
                                            @php $ext = pathinfo($msg->attachment, PATHINFO_EXTENSION); @endphp
                                            @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif','webp']))
                                                <img src="{{ asset('storage/'.$msg->attachment) }}"
                                                     style="max-width:200px;max-height:200px;border-radius:8px;margin-top:4px;"
                                                     alt="image">
                                            @else
                                                <a href="{{ asset('storage/'.$msg->attachment) }}"
                                                   target="_blank">
                                                    📎 Fichier joint
                                                </a>
                                            @endif
                                        @endif
                                        <div style="font-size:10px;opacity:.6;text-align:right;margin-top:3px;">
                                            {{ $msg->created_at->format('H:i d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Formulaire d'envoi --}}
                    <div class="card-footer p-3" style="border-top:1px solid #eee;">
                        <form action="{{ route('contact.send') }}" method="POST" enctype="multipart/form-data" id="chat-form">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $selectedUser->id }}">

                            <div class="mb-2">
                                <textarea name="body"
                                          id="message-input"
                                          class="form-control"
                                          rows="2"
                                          placeholder="Écris ton message... 😊"
                                          style="resize:none;"></textarea>
                            </div>
                            <div class="mb-2">
                                <input type="file" name="attachment" class="form-control form-control-sm" accept="image/*,application/pdf">
                            </div>
                            <button type="submit"
                                    class="btn btn-sm"
                                    style="background:#34c38f;color:#fff;border:none;padding:6px 20px;border-radius:6px;">
                                Envoyer
                            </button>
                        </form>
                    </div>

                @else
                    {{-- Pas de conversation sélectionnée --}}
                    <div class="card-body d-flex align-items-center justify-content-center h-100">
                        <div class="text-center text-muted">
                            <i class="bx bx-message-dots" style="font-size:48px;opacity:.3;"></i>
                            <p class="mt-2">Sélectionne un utilisateur pour démarrer une conversation</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
@if($selectedUser)
<script>
    // ===================================================
    // Scroll automatique en bas du chat
    // ===================================================
    function scrollToBottom() {
        var box = document.getElementById('chat-box');
        if (box) box.scrollTop = box.scrollHeight;
    }
    scrollToBottom();

    // ===================================================
    // Polling temps réel toutes les 3 secondes
    // ===================================================
    var lastId = {{ $messages->isNotEmpty() ? $messages->last()->id : 0 }};
    var selectedUserId = {{ $selectedUser->id }};
    var myId = {{ auth()->id() }};
    var myName = "{{ auth()->user()->name }}";

    function pollMessages() {
        fetch('/contact/poll?with=' + selectedUserId + '&last_id=' + lastId, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            // Nouveaux messages
            if (data.messages && data.messages.length > 0) {
                var box = document.getElementById('chat-box');
                var wasAtBottom = box.scrollHeight - box.scrollTop - box.clientHeight < 60;

                data.messages.forEach(function(msg) {
                    lastId = msg.id;
                    var html = buildMessageHtml(msg);
                    box.insertAdjacentHTML('beforeend', html);
                });

                if (wasAtBottom) scrollToBottom();
            }

            // Mise à jour des indicateurs en ligne
            if (data.online_status) {
                Object.entries(data.online_status).forEach(function([userId, isOnline]) {
                    document.querySelectorAll('.online-dot[data-user-id="' + userId + '"]').forEach(function(dot) {
                        dot.style.background = isOnline ? '#34c38f' : '#ccc';
                    });
                });
            }
        })
        .catch(function(e) { console.error('Poll error:', e); });
    }

    function buildMessageHtml(msg) {
        var isMine = msg.is_mine;
        var justify = isMine ? 'justify-content-end' : 'justify-content-start';
        var bg      = isMine ? '#5b73e8' : '#f1f3f7';
        var color   = isMine ? '#fff' : '#333';
        var nameColor = isMine ? '' : 'color:#5b73e8;';
        var radius  = isMine ? '12px 12px 0 12px' : '12px 12px 12px 0';

        var bodyHtml = msg.body ? '<div>' + escapeHtml(msg.body) + '</div>' : '';

        var attachHtml = '';
        if (msg.attachment) {
            var ext = msg.attachment.split('.').pop().toLowerCase();
            var imgExts = ['jpg','jpeg','png','gif','webp'];
            if (imgExts.includes(ext)) {
                attachHtml = '<img src="' + msg.attachment + '" style="max-width:200px;max-height:200px;border-radius:8px;margin-top:4px;" alt="image">';
            } else {
                var linkColor = isMine ? 'color:#fff;' : '';
                attachHtml = '<a href="' + msg.attachment + '" target="_blank" style="' + linkColor + 'text-decoration:underline;">📎 Fichier joint</a>';
            }
        }

        return '<div class="d-flex ' + justify + ' mb-2">' +
            '<div style="background:' + bg + ';color:' + color + ';border-radius:' + radius + ';padding:8px 14px;max-width:60%;">' +
                '<div style="font-size:11px;font-weight:600;margin-bottom:3px;' + nameColor + '">' + escapeHtml(msg.sender_name) + '</div>' +
                bodyHtml +
                attachHtml +
                '<div style="font-size:10px;opacity:.7;text-align:right;margin-top:3px;">' + msg.created_at + '</div>' +
            '</div>' +
        '</div>';
    }

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

    // Lancer le polling
    setInterval(pollMessages, 3000);

    // Envoyer avec Entrée (Shift+Entrée pour nouvelle ligne)
    document.getElementById('message-input').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('chat-form').submit();
        }
    });
</script>
@endif
@endsection
