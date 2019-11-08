<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("disciplines", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->string("difficulty");
			$table->bigInteger("teacher_id")->unsigned();
			$table->foreign("teacher_id")->references("id")->on("teachers");
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
        Schema::dropIfExists("disciplines");
    }
}
