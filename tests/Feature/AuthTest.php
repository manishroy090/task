<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades;
use App\Models\User;

class AuthTest extends TestCase
{
   use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testSuccessfulRegister(){
     

        $response =$this->postJson('api/auth/register',
        [
            'name' =>"manish",
            'email' =>"manish@gmail.com",
            'password' =>"hari@",
            'password_confirmation' =>"hari@",
        ]
    );
        $response->assertJsonCount(count:3);
    }

    public function testSuccessfulLogin(): void
    {       $user = User::factory()->create([
        'id' => random_int(1, 100),
        'password' => bcrypt($password = 'test'),
    ]);
        
        $response = $this->postJson('api/auth/login',
        ['email'=>$user->email,
        'password'=>$password]);
        $response->assertJsonCount(count:2);
    }
}
