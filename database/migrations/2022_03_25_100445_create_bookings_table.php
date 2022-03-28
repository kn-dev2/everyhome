<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('booking_id')->unique();
            $table->integer('services_id')->unsigned()->index();
            $table->integer('home_type_id')->unsigned()->index();
            $table->integer('home_sub_type_id')->nullable();
            $table->integer('customer_id')->unsigned()->index();
            $table->integer('discout_coupan_id')->nullable();
            $table->decimal('discout_price',10,2)->nullable();
            $table->decimal('total_price',10,2);
            $table->enum('schedule_type',['weekly', 'biweekly','monthly','one_time']);
            $table->enum('status',['failed', 'success']);
            $table->timestamps();

            // Relation with home type table
            $table->foreign('home_type_id')
            ->references('id')
            ->on('home_types')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE');

             // Relation with services table
             $table->foreign('services_id')
             ->references('id')
             ->on('services')
             ->onUpdate('CASCADE')
             ->onDelete('CASCADE');

             // Relation with user table
             $table->foreign('customer_id')
             ->references('id')
             ->on('users')
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
        Schema::dropIfExists('bookings');
    }
}
