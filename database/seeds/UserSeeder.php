<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uuid' => '90cffc79-f4ca-472d-b718-cb3b6136bead',
            'level' => 3,
            'name' => 'Arthaud Proust',
            'img' => '/assets/profiles/90cffc79-f4ca-472d-b718-cb3b6136bead.jpg',
            'email' => 'proust@arthaud.dev',
            'password' => Hash::make('password'),
            'bio' => 'lorem ipsum dolor sit amet',
            'max_bloc' => '6c',
        ]);



        DB::table('users')->insert([
            'uuid' => '91554725-10c9-4f8c-8879-80ed83920659',
            'level' => 1,
            'name' => 'Jean Bonnet',
            'img' => '/assets/profiles/user.png',
            'email' => 'utilisateur@email.com',
            'password' => Hash::make('password'),
            'bio' => 'lorem ipsum dolor sit amet',
            'max_bloc' => '6c',
        ]);

        DB::table('users')->insert([
            'uuid' => '91554725-5951-4b5b-a5d0-597acf83a063',
            'level' => 2,
            'name' => 'Modérateur',
            'img' => '/assets/profiles/user.png',
            'email' => 'moderateur@email.com',
            'password' => Hash::make('password'),
            'bio' => 'lorem ipsum dolor sit amet',
            'max_bloc' => '6c',
        ]);
    }
}
