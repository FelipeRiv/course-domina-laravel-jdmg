<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*  order and cart are almost the same so we create productables to replace order and delete cart migration
*/

class CreateProductablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productables', function (Blueprint $table) {
            // $table->id();
            // $table->bigInteger('order_id')->unsigned(); //! not needed

            $table->bigInteger('product_id')->unsigned();
            $table->integer('quantity')->unsigned();
            
            $table->morphs('productable'); // * it creates a type and id so we delete order id - *not needed

            // $table->foreign('order_id')->references('id')->on('orders'); //! not needed
            $table->foreign('product_id')->references('id')->on('products');

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
        Schema::dropIfExists('order_product');
    }
}
