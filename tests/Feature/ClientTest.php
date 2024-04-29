<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Client;
use Tests\TestCase;
use App\Http\Controllers\ClientController;
use App\Services\CsvService;
use App\Models\User;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     */


    public function test_client_list(): void
{
    $user = User::first(); 
    $token = $user->createToken('TestToken')->plainTextToken;
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
    ])
    ->get('api/clients')->assertJsonCount(count:2);
    
}

    public function test_client_store() : void
    {
        $client = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'address' => '123 Main St',
            'nationality' => 'USA',
            'gender' => 'Male',
            'phone' => '555-555-5555',
            'dob' => '1990-01-01',
            'education' => 'Bachelor',
            'contactmode' => 'Email',
    
        ];
         // Assuming you have a user with an associated token
    $user = User::first(); // Replace with your logic to fetch a user
    $token = $user->createToken('TestToken')->plainTextToken;

        $response=$this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])
        ->postJson('api/clients',$client)
        ->assertStatus(200) 
        ->assertJson(['message' => 'client is created successfully']);

    }

    public function test_client_details() :void{
        $client = [

            'name' => 'John Doe',
    
            'email' => 'john.doe@example.com',
    
            'address' => '123 Main St',
    
            'nationality' => 'USA',
    
            'gender' => 'Male',
    
            'phone' => '555-555-5555',
    
            'dob' => '1990-01-01',
    
            'education' => 'Bachelor',
    
            'contactmode' => 'Email',
        ];
        $index = 1;
        $user = User::first(); 
        $token = $user->createToken('TestToken')->plainTextToken;
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])
        ->postJson('api/clients',$client);
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->getJson("/api/clients/$index")
        ->assertStatus(200)
        ->assertJson([
        'clientDetails' =>$client
       ]);
    }
}