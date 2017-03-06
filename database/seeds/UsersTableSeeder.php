<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Anonymo',
            'email' => 'anonymo@email.com',
            'password' => bcrypt('shdkYd&3Kdl'),
            'bibliography' => 'Usuário Anonymous'
        ]);
    }
}
