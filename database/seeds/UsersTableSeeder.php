<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if (! DB::table('users')->first()) {
            
            DB::table('users')->insert([
                'first_name' => 'user',
                'last_name' => 'user',
                'title' => 'user',
                'email' => 'user@email.com',
                'mobile' => '0123456789',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
