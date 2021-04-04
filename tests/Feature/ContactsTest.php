<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Generator as Faker;
use Tests\TestCase;
use App\Models\Contacts;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;


class ContactsTest extends TestCase
{
    public $token;
    protected $fakerId;
    protected $fakerName;
    protected $fakerEmail;

    public function setUp(): void
    {
        parent::setUp();

        $this->fakerName = "unit Test Name" . rand();
        $this->fakerEmail = "emailUnitTest@example.net";
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_contacts()
    {
        $user = User::where('email', "all@test-poc.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/contacts');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => true,
            ]);
    }

    /**
     * Test revert api (has to be 404)
     *
     * @return void
     */
    public function test_error_contacts()
    {
        $user = User::where('email', "all@test-poc.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/contact');
        $response
            ->assertStatus(404);
    }

    /**
     * Test api create
     *
     * @return void
     */
    public function test_insert_contacts()
    {
        $user = User::where('email', "all@test-poc.com")->first();
        $token = JWTAuth::fromUser($user);

        $totalContacts = Contacts::count();

        $response = $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/contacts', ["name" => $this->fakerName, "email" => $this->fakerEmail]);
        $response->assertStatus(201);
        $this->assertTrue($totalContacts + 1 == Contacts::count());

        $this->assertTrue($response['data']['name'] == $this->fakerName);
        $this->assertTrue($response['data']['email'] == $this->fakerEmail);
        $this->fakerId = $response['data']['id'];
    }

    /**
     * Test api edit
     *
     * @return void
     */
    public function test_edit_contacts()
    {
        $user = User::where('email', "all@test-poc.com")->first();
        $token = JWTAuth::fromUser($user);

        $lastRecord = Contacts::latest("id")->first()['id'];
        $totalContacts = Contacts::count();

        $name = $this->fakerName . "editable";
        $email = "editable" . $this->fakerEmail;

        $response = $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->put('/api/contacts/' . $lastRecord, ["name" => $name, "email" => $email]);
        $response->assertStatus(200);
        $this->assertTrue($response['data']['name'] == $name);
        $this->assertTrue($response['data']['email'] == $email);
        $this->assertTrue($totalContacts == Contacts::count());
    }

    /**
     * Test api remove
     *
     * @return void
     */
    public function test_remove_contacts()
    {
        $user = User::where('email', "all@test-poc.com")->first();
        $token = JWTAuth::fromUser($user);

        $lastRecord = Contacts::latest("id")->first()['id'];
        $totalContacts = Contacts::count();

        $response = $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/contacts/' . $lastRecord);
        $response->assertStatus(200);
        $this->assertTrue($totalContacts - 1 == Contacts::count());
    }
}
