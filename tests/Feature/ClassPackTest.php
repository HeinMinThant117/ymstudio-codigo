<?php

namespace Tests\Feature;

use App\Models\ClassPack;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClassPackTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /**
     * @test
     */

    public function user_can_get_the_list_of_class_packs()
    {
        $this->withoutExceptionHandling();
        ClassPack::factory()->count(3)->create();

        $response = $this->get('api/class-packs');

        $response->assertStatus(200);
        $this->assertCount(3, $response['data']['pack_list']);
    }

    /**
     * @test
     */
    public function user_can_see_a_specific_project()
    {
        $this->withoutExceptionHandling();
        $classPack = ClassPack::factory()->create();
        $id = (string)$classPack->pack_id;

        $response = $this->get('api/class-packs/' . $id);

        $this->assertEquals($id, $response['data']['pack_id']);
        $response->assertStatus(200);
    }
}
