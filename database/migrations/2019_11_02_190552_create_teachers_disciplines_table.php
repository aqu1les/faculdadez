<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("teachers_disciplines", function (Blueprint $table) {
            $table->bigInteger("teacher_id")->unsigned();
            $table->bigInteger("discipline_id")->unsigned();
            $table->foreign("teacher_id")->references("id")->on("teachers");
            $table->foreign("discipline_id")->references("id")->on("disciplines");
            $table->primary(["teacher_id", "discipline_id"]);
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
        Schema::dropIfExists("teachers_disciplines");
    }
}
