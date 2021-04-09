<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'employee one',
                'email' => 'employeeOne@gmail.com',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'employee two',
                'email' => 'employeeTwo@gmail.com',
                'password' => bcrypt('12345678')
            ], [
                'name' => 'employee three',
                'email' => 'employeeThree@gmail.com',
                'password' => bcrypt('12345678')
            ],
        ]);

        $employeeRole = Role::employee()->first();

        $employees = User::where('name', 'like','%'.'employee'.'%')->get();

        foreach($employees as $employee){
            $employee->roles()->attach($employeeRole);
        }
    }
}
