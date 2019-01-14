<?php
namespace Tests\Unit;
use Tests\TestCase;
use Faker\Generator as Faker;
use App\User;

class ApiTest extends TestCase
{   
	private $headers = [		
        'X-Requested-With' => 'XMLHttpRequest'
    ]; 
      
     /**
     * Testando registro de novo usuário
     *
     * @return void
     * @test
    */
    public function register()
    {              
        $userFactory = factory(User::class)->make();  

        $user = $userFactory->makeVisible('password')->toArray();        
       
        $response = $this->withHeaders($this->headers)->json('POST', '/api/register', $user); 
        $response->assertStatus(201);
        $response->assertJsonStructure(['message', 'user', 'token']);        
    }     
}