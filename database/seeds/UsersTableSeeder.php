<?php

use App\models\User;
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
        User::create([
            'name' => 'DevJobs App',
            'email' => 'oi@devjob.com.br',
            'username' => 'devJobs',
            'password' => bcrypt('123456'),
            'contacts' => '',//json
            'addresses' => '',//json
            'linkedin' => 'https://www.linkedin.com/in/jefferson-hsg/',
            'git' => 'https://github.com/dev-jefferson',
            'is_active' => true,
        ]);
    }
}
