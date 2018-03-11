<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversityRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_relations', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('university_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('profile')->onDelete('cascade');
            $table->foreign('university_id')->references('university_id')->on('universities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('university_relations');
    }
}
