<?php

use Illuminate\Database\Seeder;

class RolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'description' => 'Admin Can access all, its like the owner'
        ]);
        DB::table('roles')->insert([
            'name' => 'Manager',
            'description' => 'Can only handle orders, and manage other stuff except users and roles'
        ]);
        DB::table('roles')->insert([
            'name' => 'Sales',
            'description' => 'Can only handle orders'
        ]);
    }
}
