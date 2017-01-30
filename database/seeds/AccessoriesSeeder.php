<?php

use Illuminate\Database\Seeder;

class AccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Accessory::class, 5)->create();
    }
}
