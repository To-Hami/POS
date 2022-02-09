<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');



            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('category_translations');
    }
}
