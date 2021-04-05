<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_logged_as_all_roles_user()
    {
        $response = $this->post('/api/login', [
            "email" => "all@test-poc.com",
            "password" => "password"
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => true,
                'success' => true,
                'message' => true,
            ]);
        $this->token = $response['data'];
    }
}
