<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => bcrypt('123456')
        ]);

        $user->save();
    }
}
