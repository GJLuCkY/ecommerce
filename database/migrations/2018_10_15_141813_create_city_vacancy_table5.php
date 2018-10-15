<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityVacancyTable5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_vacancy_city', function (Blueprint $table) {
            $table->integer('vacancy_city_id')->unsigned()->index();
            $table->foreign('vacancy_city_id')->references('id')->on('vacancy_cities')->onDelete('cascade');
            $table->integer('vacancy_id')->unsigned()->index();
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
            $table->primary(['vacancy_city_id', 'vacancy_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancy_vacancy_city');
    }
}
