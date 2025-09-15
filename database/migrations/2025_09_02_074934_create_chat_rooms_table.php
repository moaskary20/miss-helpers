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
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name')->nullable();
            $table->string('visitor_email')->nullable();
            $table->string('visitor_phone')->nullable();
            $table->string('session_id')->unique();
            $table->enum('status', ['active', 'closed', 'pending'])->default('active');
            $table->enum('type', ['live_chat', 'leave_message'])->default('live_chat');
            $table->text('initial_message')->nullable();
            $table->string('assigned_admin')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('last_activity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_rooms');
    }
};
