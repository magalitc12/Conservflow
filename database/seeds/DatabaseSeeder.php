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
        //App\User::factory()->count(10)->create();
        factory(App\User::class, 1)->create();
    }
}
