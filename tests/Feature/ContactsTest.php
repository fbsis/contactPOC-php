<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Generator as Faker;
use Tests\TestCase;
use App\Models\Contacts;

class ContactsTest extends TestCase
{
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
        $response = $this->get('/api/contacts');
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
        $response = $this->get('/api/contact');
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
        $totalContacts = Contacts::count();

        $response = $this->post('/api/contacts', ["name" => $this->fakerName, "email" => $this->fakerEmail]);
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
        $lastRecord = Contacts::latest("id")->first()['id'];
        $totalContacts = Contacts::count();

        $name = $this->fakerName . "editable";
        $email = "editable" . $this->fakerEmail;

        $response = $this->put('/api/contacts/' . $lastRecord, ["name" => $name, "email" => $email]);
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
        $lastRecord = Contacts::latest("id")->first()['id'];
        $totalContacts = Contacts::count();

        $response = $this->delete('/api/contacts/' . $lastRecord);
        $response->assertStatus(200);
        $this->assertTrue($totalContacts - 1 == Contacts::count());
    }
}
