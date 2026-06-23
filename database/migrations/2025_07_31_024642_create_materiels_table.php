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
       
       Schema::create('materiels', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('numero_serie');
    $table->string('type');
    $table->enum('etat', ['Neuf', 'Bon', 'Endommagé', 'En réparation']);
    $table->date('date_acquisition');
    $table->timestamps();
});



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiels');
    }
};
