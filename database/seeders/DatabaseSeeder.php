<?php

namespace Database\Seeders;

use Database\Seeders\BookableTableSeeder;
use Database\Seeders\BookingsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ReviewsTableSeeder;
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
        $this->call(UsersTableSeeder::class);
        $this->call(BookableTableSeeder::class);
        $this->call(BookingsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
    }
}
