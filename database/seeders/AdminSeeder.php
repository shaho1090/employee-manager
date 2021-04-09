<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
           'name' => 'admin',
           'email' => 'admin@gmail.com',
           'password' => bcrypt('12345678')
       ]);

       User::where('email','admin@gmail.com')->first()->roles()->attach(Role::admin()->first());
    }
}
