<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memorial_page_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memorial_page_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['memorial_page_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memorial_page_user');
    }
};
