<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Pacient;

class AuthorizationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    
    public function testLogin(): void
    {
        $response = $this->get('/login');

        $response = $this->post('/login', [
            'login' => 'login',
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
     

    }
    
}
