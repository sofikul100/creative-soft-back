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
        Schema::create('project_pricings', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('pricing_type_name');
            $table->string('pricing_ammount');
            $table->string('pricing_features');
            $table->string('is_populer')->default('0');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_pricings');
    }
};
