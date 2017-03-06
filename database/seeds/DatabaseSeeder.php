<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTablesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AccessoriesSeeder::class);
        $this->call(FlowersSeeder::class);
        $this->call(ServicesTableSeeder::class);
        
    }
}
