<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AuthTest extends TestCase
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
     **/
    public function user_can_login_with_correct_credentials()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('api/login', ['email' => $user->email, 'password' => 'password']);
        $tokenData = $response->getOriginalContent()->toArray();

        $response->assertStatus(200);
        $this->assertDatabaseHas('oauth_access_tokens', $tokenData['token']->only('id'));
    }

    /**
     * @test
     **/
    public function user_cannot_login_with_incorrect_credentials()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('api/login', ['email' => 'test@gmail.com', 'password' => 'testsasdfasdf']);

        $response->assertStatus(401);
    }


    /**
     * @test
     **/
    public function validation_errors_show_correctly_for_logging_in()
    {
        $response = $this->json('POST', 'api/login', ['email' => 'test@gmail.com']);
        $response->assertStatus(422);

        $response = $this->json('POST', 'api/login', ['password' => 'test1234']);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function user_can_register_with_correct_data()
    {
        // $this->withoutExceptionHandling();
        $registerData = [
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => 'test1234',
            'confirm_password' => 'test1234'
        ];
        $response = $this->post('api/register', $registerData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', Arr::only($registerData, ['email']));
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
