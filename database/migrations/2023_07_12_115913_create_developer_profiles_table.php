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
        Schema::create('developer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained();
            $table->string('name');
            $table->string('hero');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->longText('bio');
            $table->enum('search_status', ['actively looking', 'open', 'not interested', 'invisible'])->nullable();
            $table->enum('role_level', ['junior', 'mid', 'senior', 'principal'])->nullable();
            $table->boolean('part_time')->default(false);
            $table->boolean('full_time')->default(false);
            $table->boolean('contract')->default(false);
            $table->string('website')->nullable();
            $table->string('github')->nullable();
            $table->string('twitter')->nullable();
            $table->string('stack_overflow')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('image')->nullable();
            $table->boolean('email_notifications')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developer_profiles');
    }
};
