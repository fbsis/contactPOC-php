<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeleteEmail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

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
        $contacts = Contacts::factory()->make();
        $name = $contacts->name;
        $email = $contacts->email;
        $this->assertNotEmpty($name);
        $this->assertNotEmpty($email);
        $this->assertIsString($name);
        $this->assertIsString($email);
    }

    /**
     * Test can delete contact
     *
     * @return void
     */
    public function test_contact_must_send_email_on_delete()
    {
        Mail::fake();

        $contacts = Contacts::factory()->make();
        $this->assertDeleted($contacts);
    }

    /**
     * Test email is sending
     *
     * @return void
     */
    public function test_send_email_contacts()
    {
        Mail::fake();
        $mailable = new DeleteEmail("test@test.com");
        Mail::send($mailable);
        Mail::assertSent(DeleteEmail::class);
    }
}
