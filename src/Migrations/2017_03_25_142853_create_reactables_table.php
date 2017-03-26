<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReactablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reactables', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('reaction_id');
            $table->integer('reactable_id');
            $table->string('reactable_type');

            $table->integer('responder_id');
            $table->string('responder_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reactables');
    }
}
