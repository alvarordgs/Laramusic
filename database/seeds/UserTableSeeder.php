<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Alvaro Rodrigues',
            'email'     => 'alvaro@site.com',
            'password'  =>  bcrypt('123456'),
        ]);
    }
}
