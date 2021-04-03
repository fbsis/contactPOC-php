<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Contacts;

class ContactModelTest extends TestCase
{
    /**
     * Database must exists
     *
     * @return void
     */
    public function test_contact_model_must_exists()
    {
        $this->assertTrue(class_exists(Contacts::class));
    }

    /**
     * Test model can be populate with name and it is valid
     *
     * @return void
     */
    public function test_contact_must_have_name_and_email()
    {
        $contacts = \App\Models\User::factory(Contacts::class)->make();
        $name = $contacts->name;
        $email = $contacts->email;
        $this->assertNotEmpty($name);
        $this->assertNotEmpty($email);
        $this->assertIsString($name);
        $this->assertIsString($email);
    }
}
