<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up()
    {
        Schema::table('vidas', function (Blueprint $table) {
            $table->timestamp('last_updated')->nullable();
        });
    }
    

    public function down(): void
    {
        Schema::table('vidas', function (Blueprint $table) {
            //
        });
    }
};
