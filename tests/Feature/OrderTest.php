<?php

namespace Tests\Feature;

use App\Models\ClassPack;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
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
    public function user_can_place_order_with_correct_credentials()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->json('POST', 'api/login', ['email' => $user->email, 'password' => 'password']);
        $tokenData = $response->getOriginalContent()['data'];

        $classpack = ClassPack::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $tokenData['token']])->json('POST', 'api/orders', ['pack_id' => $classpack['pack_id'], 'qty' => 1, 'promocode' => null]);

        $response->assertStatus(201);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $tokenData['token']])->json('POST', 'api/orders', ['pack_id' => $classpack['pack_id'], 'qty' => 1, 'promocode' => null]);


        $this->assertDatabaseCount('orders', 2);
        $this->assertDatabaseCount('class_pack_order', 2);

        $this->assertDatabaseHas('orders', Arr::only($response['data'], ['id', 'user_id']));
    }

    /**
     * @test
     */
    public function user_cant_place_order_with_incorrect_credentials()
    {

        $classpack = ClassPack::factory()->create();

        $response = $this->withHeaders([])->json('POST', 'api/orders', ['pack_id' => $classpack['pack_id'], 'qty' => 1]);

        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function user_can_view_thier_order()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->json('POST', 'api/login', ['email' => $user->email, 'password' => 'password']);
        $tokenData = $response->getOriginalContent()['data'];

        $classpack = ClassPack::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $tokenData['token']])->json('POST', 'api/orders', ['pack_id' => $classpack['pack_id'], 'qty' => 1, 'promocode' => null]);

        $response->assertStatus(201);

        $response = $this->json('GET', 'api/orders/' . intval($response['data']['id']));

        $response->assertStatus(200);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
