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
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('method');
            $table->string('url');
            $table->json('payload')->nullable();
            $table->json('response')->nullable();
            $table->integer('status_code');
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->float('execution_time')->nullable();
            $table->timestamps();
            
            // Add index for faster queries
            $table->index(['user_id', 'created_at']);
            $table->index(['status_code', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_logs');
    }
};
