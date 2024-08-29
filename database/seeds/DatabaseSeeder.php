<?php


namespace Database\Seeders;

use Database\Seeders\UsersTableSeeder as SeedersUsersTableSeeder;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SeedersUsersTableSeeder::class,
        ]);
    }
}
