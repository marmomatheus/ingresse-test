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

    /**
     * Testando login
     *
     * @return void
     * @test
    */
    public function login()
    {        
        $userFactory = factory(User::class)->make();  

        $user = $userFactory->makeVisible('password')->toArray();
            
        $newUser = $this->withHeaders($this->headers)->json('POST', '/api/register', $user);                

        $response = $this->withHeaders($this->headers)->json('POST', '/api/login', ['email' => $user['email'], 'password' => $user['password']]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'token']);            
    }    
}