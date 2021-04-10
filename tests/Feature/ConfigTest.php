<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class ConfigTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_view_config()
    {
        $user = User::where('email', "all@test-poc.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this
            ->withHeaders(
                [
                    'Authorization' => 'Bearer ' . $token,
                ]
            )
            ->get('/api/config');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => true,
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_set_config()
    {
        $user = User::where('email', "all@test-poc.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this
            ->withHeaders(
                [
                    'Authorization' => 'Bearer ' . $token,
                ]
            )
            ->post('/api/config', ["onDeletecontacts" => "novaconfig@poc.com"]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => true,
            ]);
    }
}
