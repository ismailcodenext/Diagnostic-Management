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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('img_url')->nullable();
            $table->string('specialization');
            $table->string('degree');
            $table->string('hospital')->nullable();
            $table->string('chamber_address')->nullable();
            $table->string('mobile');
            $table->string('registration_number')->nullable();

            // Adding user_id column for foreign key constraint
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
