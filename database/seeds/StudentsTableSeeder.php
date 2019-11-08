<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("students")->insert([
            "name" => "Felipe Barros",
            "cpf" => "06537667186",
            "registration" => "01224729",
            "password" => \Illuminate\Support\Facades\Hash::make("Aquiles123"),
            "current_semester" => "5",
            "course_id" => 1
        ]);
    }
}
