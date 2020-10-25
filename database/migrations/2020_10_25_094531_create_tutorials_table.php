<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('level');
            $table->string('order');
            $table->boolean('completed')->default(0);
            $table->timestamps();
        });
        Schema::create('tutorials_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('order');
            $table->foreignId('tutorial_id');
            $table->foreign('tutorial_id')->references('id')->on('tutorials')->onDelete('cascade');
        });
        Schema::create('tutorial', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->integer('order');
            $table->foreignId('tutorial_id');
            $table->foreignId('section_id');
            $table->boolean('completed')->default(0);
            $table->boolean('published')->default(0);
            $table->timestamps();
            $table->foreign('tutorial_id')->references('id')->on('tutorials')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('tutorials_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutorials');
        Schema::dropIfExists('tutorials_sections');
        Schema::dropIfExists('tutorial');
    }
}
