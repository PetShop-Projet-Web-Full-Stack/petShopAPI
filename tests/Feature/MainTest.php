<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MainTest extends TestCase
{

    use RefreshDatabase;

    protected $url = 'api/';
    protected $completeUrl;

    protected function setUp(): void
    {
        parent::setUp();
        $this->get('/sanctum/csrf-cookie');
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    protected function testListNotEmpty($completeUrl = ''): void
    {
        $finalUrl = $this->url . $completeUrl;
        $response = $this->get($finalUrl);
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    protected function testGetById($completeUrl = '', $id): void
    {
        $finalUrl = $this->url . $completeUrl . '/' . $id;
        $response = $this->get($finalUrl);
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    protected function testCreateEntity($completeUrl, $entityToCreate, $databaseTableName)
    {
        $finalUrl = $this->url . $completeUrl;
        $response = $this->post($finalUrl, $entityToCreate);
        $response->assertStatus(200)
            ->assertJsonFragment($entityToCreate);

        $this->assertDatabaseHas($databaseTableName, $entityToCreate);
        return $response;
    }
}
