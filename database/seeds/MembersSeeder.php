<?php

use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'name' => 'Arthaud Proust',
        ]);

        DB::table('members')->insert([
            'name' => 'Guilhem Granier',
        ]);

        DB::table('members')->insert([
            'name' => 'Test Man',
        ]);
    }
}
