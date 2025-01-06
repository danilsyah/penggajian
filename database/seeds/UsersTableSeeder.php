<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'    => 'admin',
            'email'    => 'admin@mail.com',
            'password'    => bcrypt('admin'),
            'is_admin'  => '1'
        ]);
    }
}
