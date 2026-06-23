<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->text('body')->nullable();
            $table->string('attachment')->nullable(); // chemin fichier/image
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // Colonne last_seen pour le statut en ligne
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_seen')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_seen');
        });
    }
};
