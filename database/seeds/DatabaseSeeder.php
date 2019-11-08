<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(TeachersTableSeeder::class);
		$this->call(CoursesTableSeeder::class);
		$this->call(StudentsTableSeeder::class);
		$this->call(DisciplinesTableSeeder::class);
		$this->call(DisciplinesCoursesTableSeeder::class);
		$this->call(StudentsDisciplinesTableSeeder::class);
		$this->call(SchedulesTableSeeder::class);
	}
}
