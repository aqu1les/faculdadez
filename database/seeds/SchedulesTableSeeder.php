<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i = 1; $i <= 39; $i++) {
    		switch ($i) {
				case 1: case 6:case 11:case 16: case 21: case 26: case 31: case 36:
					DB::table("schedules")->insert([
						"discipline_id" => $i,
						"weekday" => "Segunda-feira",
						"starts" => "08:00",
						"ends" => "12:00"
					]);
					break;
				case 2: case 7: case 12: case 17: case 22: case 27: case 32: case 37:
					DB::table("schedules")->insert([
						"discipline_id" => $i,
						"weekday" => "Terça-feira",
						"starts" => "08:00",
						"ends" => "12:00"
					]);
					break;
				case 3: case 8: case 13: case 18: case 23: case 28: case 33: case 38:
					DB::table("schedules")->insert([
						"discipline_id" => $i,
						"weekday" => "Quarta-feira",
						"starts" => "08:00",
						"ends" => "12:00"
					]);
					break;
				case 4: case 9: case 14: case 19: case 24: case 29: case 34: case 39:
					DB::table("schedules")->insert([
						"discipline_id" => $i,
						"weekday" => "Quinta-feira",
						"starts" => "08:00",
						"ends" => "12:00"
					]);
					break;
				case 5: case 10: case 15: case 20: case 25: case 30: case 35:
					DB::table("schedules")->insert([
						"discipline_id" => $i,
						"weekday" => "Sexta-feira",
						"starts" => "08:00",
						"ends" => "12:00"
					]);
					break;
				default:
					break;
			}
		}
    }
}
