<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('cedula')->unique();
            $table->string('cargo')->default('GUARDALMACEN');
            $table->string('area')->default('ADMINISTRATIVO');
            $table->integer('id_institucion')->nullable();
            $table->boolean('ha_establecido_contrasenia')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nombres',
                'apellidos',
                'cedula',
                'cargo',
                'area',
                'id_institucion',
            ]);
        });
    }
}
