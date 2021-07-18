<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('status')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->dateTime('register_end')->nullable();

            $table->string('logo')->nullable();
            $table->integer('max_participant')->default(1);

            $table->float('percent_prize')->default(1.0);
            $table->bigInteger('entrance_fee')->default(0);
            $table->float('ensure_won')->nullable();

            $table->integer('api_id')->nullable();
            $table->boolean('notified')->default(false);
            $table->integer('winner_id')->nullable();

            $table->json('additional_info')->nullable();

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
        Schema::dropIfExists('tournaments');
    }
}
