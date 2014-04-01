<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('users')->delete();
        User::create(array(
                'username' => 'test',
                'password' => Hash::make('password'),
                'email' => 'test@test.com',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
    }

}