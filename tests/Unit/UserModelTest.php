<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories;

class UserModelTest extends TestCase
{
    /**
     * Database must exists
     *
     * @return void
     */
    public function test_user_model_must_exists()
    {
        $this->assertTrue(class_exists(User::class));
    }

    /**
     * Test model can be populate with name and it is valid
     *
     * @return void
     */
    public function test_user_can_have_name()
    {
        $users = \App\Models\User::factory(User::class)->make();
        $name = $users->name;
        $this->assertNotEmpty($name);
        $this->assertIsString($name);
    }

    /**
     * Test with model can be populate
     *
     * @return void
     */
    public function test_user_can_have_email()
    {
        $users = \App\Models\User::factory(User::class)->make();
        $email = $users->email;
        $this->assertNotEmpty($email);
        $this->assertIsString($email);
    }
    
}
