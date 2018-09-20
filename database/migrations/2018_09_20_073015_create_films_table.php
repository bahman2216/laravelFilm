<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('the name of film');
            $table->string('slug', 100)->comment('the slug of film');
            $table->text('description')->comment('the description of film');
            $table->date('release_date')->comment('the release date of film');
            $table->tinyInteger('rating')->unsigned()->comment('the rating of film. between 1 to 5');
            $table->integer('ticket_price')->unsigned()->comment('the ticket price of film. price in $');
            $table->string('country_code', 3)->comment('the country of film. country list stored in config file');
            $table->binary('photo')->comment('the photo of film.');

	        $table->softDeletes();
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
        Schema::dropIfExists('films');
    }
}
