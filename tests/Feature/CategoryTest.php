<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public $prefix = 'api/category/';

    /** @test */
    public function test_category_can_be_added_in_categories()
    {
        $name = 'TestCategory123';
        $response = $this->post($this->prefix, ['name' => $name]);

        $response->assertStatus(200);
    }

    public function test_category_exist_in_categories()
    {
        $name = 'TestCategory123';
        $response = $this->post($this->prefix, ['name' => $name]);

        $response->assertStatus(404);
        $this->assertEquals('MSG_CATEGORY_IS_EXIST', $response['msg']);
    }

    public function test_category_can_update()
    {
        $categoryId = Category::first()->id;
        $name = 'Books';
        $response = $this->put($this->prefix . $categoryId, ['name' => $name]);
        $category = Category::find($categoryId);

        $this->assertEquals($name, $category->name);
    }

    public function test_category_field_miss_update()
    {
        $categoryId = Category::first()->id;
        $response = $this->put($this->prefix . $categoryId);

        $response->assertStatus(400);
        $this->assertEquals('MSG_FIELD_MISSING', $response['msg']);
    }

    public function test_category_not_exist_in_categories_update()
    {
        $id = 100;
        $name = 'Books';
        $response = $this->put($this->prefix . $id, ['name' => $name]);

        $response->assertStatus(404);
        $this->assertEquals('MSG_CATEGORY_NOT_EXIST', $response['msg']);
    }

    public function test_category_can_delete()
    {
        $categoryId = Category::first()->id;
        $response = $this->delete($this->prefix . $categoryId);
        $category = Category::find($categoryId);

        $response->assertStatus(200);
        $this->assertNull($category);
    }

    public function test_category_not_exist_in_categories_delete()
    {
        $id = 100;
        $response = $this->delete($this->prefix . $id);
        var_dump($response['success']);

        $response->assertStatus(404);
        $this->assertEquals('MSG_CATEGORY_NOT_EXIST', $response['msg']);
    }
}
