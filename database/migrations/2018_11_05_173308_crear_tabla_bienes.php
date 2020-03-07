<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaBienes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->enum('clase',['CONTROL ADMINISTRATIVO', 'PROPIEDAD, PLANTA Y EQUIPO']);
            $table->integer('id_ubicacion');
            $table->date('fecha_de_adquisicion')->nullable();
            $table->string('acta_de_recepcion')->nullable();
            $table->string('imagen')->nullable();
            $table->text('observaciones')->nullable();
            $table->decimal('valor', 8, 2)->nullable();
            $table->string('codigo_barras')->unique()->nullable();
            $table->string('codigo_qr')->unique()->nullable();
            $table->integer('id_padre')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bienes');
    }
}
