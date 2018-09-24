<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	\Artisan::call('database:populate', ['file_name' => 'businesses.csv']);
        // $this->call(UsersTableSeeder::class);
    }
}
