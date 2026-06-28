<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         // ensure leftover tables from previous runs do not break migration in dev
         Schema::dropIfExists('chats');

         Schema::create('chats', function (Blueprint $table) {
            $table->id();

            // terkait klaim (chat terjadi dalam konteks klaim)
            $table->foreignId('claim_id')->constrained('claims')->onDelete('cascade');

            // siapa pengirim
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');

            // siapa penerima (kalau private chat) - bisa null for group/system messages
            $table->foreignId('receiver_id')->nullable()->constrained('users')->onDelete('cascade');

            // isi pesan
            $table->text('message');

            // status pesan (opsional)
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
