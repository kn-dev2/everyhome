<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->comment('1 - Quantity wise, 2 - Only single item');
            $table->integer('service_id')->unsigned()->index();
            $table->string('title');
            $table->string('icon');
            $table->decimal('price',10,2);
            $table->integer('status')->comment('1 - Active, 2 - In-Active');
            $table->timestamps();

             // Relation with services table
             $table->foreign('service_id')
             ->references('id')
             ->on('services')
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
        Schema::dropIfExists('extra_services');
    }
}
