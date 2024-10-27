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
        Schema::create('adoption_interests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('adoption_id')->constrained('adoption')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('housing_type', ['Casa', 'Apartamento']);
            $table->string('availability');
            $table->text('experience')->nullable();
            $table->text('other_animals')->nullable();
            $table->text('reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_interests');
    }
};
