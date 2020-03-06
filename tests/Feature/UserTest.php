<?php

namespace Tests\Feature;

use App\models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function testCreateUser()
    {
        $user = User::create([
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

        $response = $this->postJson('/api/auth/login',
        [
            'username' => $user->username,
            'password' => $user->password,
        ]);

        $response->assertStatus(200);
    }
}
