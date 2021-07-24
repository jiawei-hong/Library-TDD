<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    public $prefix = 'api/author/';

    /** @test */
    public function test_author_can_be_added_in_author()
    {
        [$firstName, $lastName] = explode(' ', 'Caesar Allen');

        $response = $this->post($this->prefix, [
            'firstname' => $firstName,
            'lastname' => $lastName
        ]);

        $response->assertOk();
        $this->assertTrue($response['success']);
        $this->assertEmpty($response['msg']);
        $this->assertIsInt($response['data']);
    }

    public function test_check_author_miss_field_in_add_method()
    {
        [$firstName, $lastName] = explode(' ', 'Caesar Allen');

        $response = $this->post($this->prefix, ['firstname' => $firstName]);

        $response->assertStatus(400);
        $this->assertFalse($response['success']);
        $this->assertEquals('MSG_FIELD_MISSING', $response['msg']);
        $this->assertEmpty($response['data']);
    }

    public function test_check_author_is_exist()
    {
        [$firstName, $lastName] = explode(' ', 'Caesar Allen');

        $response = $this->post($this->prefix, [
            'firstname' => $firstName,
            'lastname' => $lastName
        ]);

        $response->assertStatus(409);
        $this->assertFalse($response['success']);
        $this->assertEquals('MSG_AUTHOR_IS_EXIST', $response['msg']);
        $this->assertEmpty($response['data']);
    }

    public function test_author_update()
    {
        $author_id = Author::first()->id;
        [$firstname, $lastname] = explode(' ', 'Astrid Bean');

        $response = $this->put($this->prefix . $author_id, [
            'firstname' => $firstname,
            'lastname' => $lastname
        ]);

        $response->assertOk();
        $this->assertTrue($response['success']);
        $this->assertEmpty($response['msg']);
        $this->assertEmpty($response['data']);
    }

    public function test_author_update_not_exist()
    {
        $id = 100;
        $response = $this->put($this->prefix . $id);

        $response->assertNotFound();
        $this->assertFalse($response['success']);
        $this->assertEquals('MSG_AUTHOR_NOT_EXIST', $response['msg']);
        $this->assertEmpty($response['data']);
    }

    public function test_author_destroy()
    {
        $author = Author::first();
        $response = $this->delete($this->prefix . $author->id);

        $response->assertStatus(200);
        $this->assertTrue($response['success']);
        $this->assertEmpty($response['msg']);
        $this->assertEmpty($response['data']);
    }
}
