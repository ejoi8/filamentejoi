<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\EmploymentInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmploymentInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employment_information')->truncate();
        
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            EmploymentInformation::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'job_title' => $faker->jobTitle,
                'department' => $faker->word,
                'date_of_joining' => $faker->date,
                'employment_status' => $faker->randomElement(['Full-time', 'Part-time']),
                'work_location' => $faker->city,
                'base_salary' => $faker->randomFloat(2, 30000, 100000),
                'bonuses' => $faker->randomFloat(2, 1000, 10000),
                'allowances' => $faker->randomFloat(2, 500, 5000),
            ]);
        }
    }
}
