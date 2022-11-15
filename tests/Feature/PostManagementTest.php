<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Supplier;

class PostManagementTest extends TestCase
{
    /** @test */
    public function testCreateUser_postProduct()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $test_post = [
            "name" => "Alejandro Rodriguez",
            "nit" => "1000745342",
            "phone" => "3206870845",
            "email" => "alejo@supplier",
            "observation" => "vendo arepas",
        ];

        $response = $this->actingAs($user)->post('/admin/suppliers/create', $test_post);
        
        $post=Supplier::all()->toArray();
        
        $this->assertEquals(end($post)['name'], $test_post['name']);
        $this->assertEquals(end($post)['nit'], $test_post['nit']);
        $this->assertEquals(end($post)['phone'], $test_post['phone']);
        $this->assertEquals(end($post)['email'], $test_post['email']);
        $this->assertEquals(end($post)['observation'], $test_post['observation']);
        

    }

}