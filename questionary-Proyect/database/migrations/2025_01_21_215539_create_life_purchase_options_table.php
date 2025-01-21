<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_life_purchase_options_table.php

    public function up()
    {
        Schema::create('life_purchase_options', function (Blueprint $table) {
            $table->id();
            $table->integer('lives_quantity'); 
            $table->decimal('price', 8, 2); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('life_purchase_options');
    }
};
