<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->truncate();
        
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Employee::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'date_of_birth' => $faker->date,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'employee_id' => $faker->unique()->randomNumber,
            ]);
        }
    }
}
