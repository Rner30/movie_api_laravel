<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    
    // public function test_if_a_user_is_create_correctly()
    // {
    //     $response = $this->post('/api/user',[
    //         'name' => $this->faker->name,
    //         'email' => $this->faker->email,
    //         'password' => '12345',
    //         'is_admin' => $this->faker->boolean(10)
    //     ]);
    
    //     $response->assertStatus(201)->assertJsonStructure([
    //         'data'=> ['id','name','email','password'],
    //         'token' 
    //     ]);
    // }
    // public function test_login ()
    // {
    //     $response = $this->post('/api/user/login',[
    //         'email' => 'maxie83@schultz.net',
    //         'password' => '12345'
    //     ]);

    //     $response->assertStatus(200);
    // }   

    public function test_update_user()
    {
        $user = User::all()->first()->id;
        
        $response = $this->withToken('auth')->put('/api/user/'.$user,[
            'name' => 'Maria'
        ]);

        $response->assertJsonStructure();

    }
}
