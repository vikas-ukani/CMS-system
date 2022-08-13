<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;

class PageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRunPageSite()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }


    /**
     * Create Test for Page Exist or not
     *
     * @return void
     */
    public function testCreatePageExist()
    {
        $response = $this->get('/create');

        $response->assertStatus(200);
    }

    /**
     * Test for getting all pages lists
     *
     * @return void
     */
    public function testGetAllPagesListAtHomePage()
    {
        $response = $this->json('GET', '/api/pages');
        return $response->assertStatus(200);
    }

    /**
     * Test for craete test api
     *
     * @return void
     */
    public function testCreateTestPageApi()
    {
        $response = $this->json('POST', '/api/pages', [
            'title' => Str::random(20),
            'slug' => Str::random(20),
            'parent_id' => null,
            'content' => "<p>". Str::random(20) ."</p>"

            // 'title' => 'Test Title',
            // 'slug' => 'test-title',
            // 'parent_id' => null,
            // 'content' => "<p>Test Page Contents.</p>"
        ]);
        return $response->assertStatus(201);
    }
}
