<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned()->index();
            $table->integer('extra_service_id')->unsigned()->index();
            $table->integer('qty');
            $table->decimal('base_price',10,2);
            $table->decimal('price',10,2);
            $table->timestamps();

             // Relation with extra services table
             $table->foreign('extra_service_id')
             ->references('id')
             ->on('extra_services')
             ->onUpdate('CASCADE')
             ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_items');
    }
}
