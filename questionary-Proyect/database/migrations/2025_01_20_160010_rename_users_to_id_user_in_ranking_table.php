<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ranking', function (Blueprint $table) {
            // Cambiar el nombre de la columna
            $table->renameColumn('users', 'id_user');
        });
    }

    public function down()
    {
        Schema::table('ranking', function (Blueprint $table) {
            // Revertir el cambio en caso de rollback
            $table->renameColumn('id_user', 'users');
        });
    }
};
