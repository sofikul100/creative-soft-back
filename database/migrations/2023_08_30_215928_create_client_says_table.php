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
        Schema::create('client_says', function (Blueprint $table) {
            $table->id();
            $table->string('client_image');
            $table->string('client_message');
            $table->string('client_name');
            $table->string('client_position');
            $table->string('status')->default('active');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_says');
    }
};
