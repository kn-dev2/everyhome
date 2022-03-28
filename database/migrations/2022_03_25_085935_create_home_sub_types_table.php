<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSubTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_sub_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home_type_id')->unsigned()->index();
            $table->string('title');
            $table->integer('status')->comment('1 - Active, 2 - In-Active');
            $table->timestamps();

            // Relation with home type table
            $table->foreign('home_type_id')
            ->references('id')
            ->on('home_types')
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
        Schema::dropIfExists('home_sub_types');
    }
}
