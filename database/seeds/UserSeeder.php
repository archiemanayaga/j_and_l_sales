<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
            'name' => 'Archie Manayaga',
            'email' => 'manayaga_archieng05@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
