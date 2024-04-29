<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Client;
use Tests\TestCase;
use App\Http\Controllers\ClientController;
use App\Services\CsvService;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_client_list(): void
{
    // Arrange
    $response = $this->get('api/clients');
    $response->assertJsonCount(count:2);
    
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

        $response=$this->postJson('api/clients',$client)
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
        $this->postJson('api/clients',$client);
        $response = $this->getJson("/api/clients/$index")
        ->assertStatus(200)
        ->assertJson([
        'clientDetails' =>$client
       ]);
    }
}