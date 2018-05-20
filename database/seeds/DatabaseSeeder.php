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
        \App\Lesson::truncate();
        $this->call(LessonsTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
