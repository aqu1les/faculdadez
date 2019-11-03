<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_disciplines', function (Blueprint $table) {
            $table->bigInteger("student_id")->unsigned();
            $table->bigInteger("discipline_id")->unsigned();
            $table->float('final_average')->nullable();
            $table->string('status')->nullable();
            $table->foreign("student_id")->references("id")->on("students");
            $table->foreign("discipline_id")->references("id")->on("disciplines");
            $table->primary(["student_id", "discipline_id"]);
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
        Schema::dropIfExists('students_disciplines');
    }
}
