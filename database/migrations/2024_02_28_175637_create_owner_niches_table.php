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
        Schema::create('owner_niches', function (Blueprint $table) {
            $table->id();
            $table->string('niche_id');
            $table->text('owner_photo');
            $table->string('biography');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('death_date');
            $table->date('birth_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_niches');
    }
};
