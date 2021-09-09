<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessfulRegister()
    {
        $response = $this->post('/api/register', [
            "name" => "Jack Sparrow",
            "address1" => "Rock Haven Way",
            "address2" => "#125",
            "city" => "Sterling",
            "state" => "VA",
            "country" => "USA",
            "zipCode" => "zip",
            "phoneNo1" => "555-666-7777",
            "phoneNo2" => "555-666-7777",
            "user" => [
                "firstName" => "Jhon",
                "lastName" => "Doe",
                "email" => "test@example.com",
                "password" => "password",
                "passwordConfirmation" => "password",
                "phone" => "123-456-7890"
            ]
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('clients', ['id' => 1]);
        $this->assertDatabaseHas('users', ['client_id' => 1]);
    }

    public function testUnsuccessfulRegister()
    {
        $response = $this->post('/api/register', [
            "name" => "Client name",
            "address_1" => "933 NE 69th St",
            "address_2" => "second address",
            "city" => "Oklahoma",
            "state" => "Oklahoma",
            "country" => "USA",
            "zipCode" => "zip",
            "phoneNo1" => "client phone",
            "phoneNo2" => "",
            "user" => [
                "firstName" => "Jhon",
                "lastName" => "Doe",
                "password" => "password",
                "passwordConfirmation" => "password",
                "phone" => "123-456-7890"
            ]
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(422);
    }
}
