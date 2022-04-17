<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase, WithFaker;

    function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
    }


    /**
     * @test
     */
    public function you_can_place_order_with_correct_credentials()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->json('POST', 'api/login', ['email' => $user->email, 'password' => 'password']);
        $tokenData = $response->getOriginalContent()['data'];

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $tokenData['token']])->post('api/orders');

        $response->assertStatus(201);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
