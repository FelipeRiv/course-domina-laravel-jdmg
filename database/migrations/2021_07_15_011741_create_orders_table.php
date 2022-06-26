<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    
    // * Order debe venir antes de Payment por la relacion que tienen ya que un pago pertenece a una Orden o sea la Orden viene primero asi que si da error en las migraciones la solucion es cambiar el nombre en la fecha que sale para que se ejecute primero Order si se creara dspues de Payment por error en el nombre sale el timestamp solo cambiar uno por el otro

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending'); // a order is pending by default 
            // customer id es FK
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
        Schema::dropIfExists('orders');
    }
}
