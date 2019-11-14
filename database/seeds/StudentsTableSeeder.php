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
            "cpf" => "12312312389",
            "registration" => "01224729",
            "password" => \Illuminate\Support\Facades\Hash::make("secret"),
            "current_semester" => "5",
            "course_id" => 1
        ]);
    }
}
