<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Pago', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); 
            $table->foreignId('life_purchase_option_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2); 
            $table->string('payment_status'); 
            $table->string('payment_method'); 
            $table->string('preference_id'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Pago');
    }
};
