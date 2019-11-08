<?php

use Illuminate\Database\Seeder;

class StudentsDisciplinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 39; $i++) {
        	if ($i <= 20) {
				DB::table("students_disciplines")->insert([
					"student_id" => "1",
					"discipline_id" => "$i",
					"final_average" => rand(7, 10),
					"status" => "Aprovado"
				]);
			} else {
				DB::table("students_disciplines")->insert([
					"student_id" => "1",
					"discipline_id" => "$i",
					"final_average" => null,
					"status" => null
				]);
			}

        }
    }
}
