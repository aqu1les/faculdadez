<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinesCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("disciplines_courses", function (Blueprint $table) {
            $table->bigInteger("discipline_id")->unsigned();
            $table->bigInteger("course_id")->unsigned();
            $table->integer("semester");
            $table->foreign("discipline_id")->references("id")->on("disciplines");
            $table->foreign("course_id")->references("id")->on("courses");
            $table->primary(["discipline_id", "course_id"]);
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
        Schema::dropIfExists("disciplines_courses");
    }
}
