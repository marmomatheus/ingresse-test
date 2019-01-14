<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;

class AuthenticationController extends Controller
{       
    /**
     * Realiza uma tentativa de login e se for valida retorna o token
     *
     * @param  \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $attempt = Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);

        if ($attempt) {
            $user = Auth::user();

            $token = $user->createToken('Personal')->accessToken;
            return response([
                'message' => 'Success!',
                'token' => $token,
            ], 200);
        } else {
            return response(['error' => 'Invalid Credentials'], 401);
        }
    }
  
      /**
     * Cria um novo usuário e sua respectiva empresa e retorna o token de autenticação.
     *
     * @param  \App\Http\Requests\UserRequest  $requestUser
     * @param  \App\Repositories\UserRepository $repositoryUser     
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $requestUser, UserRepository $repositoryUser)
    {     
        $user = $repositoryUser->save($requestUser);
        if ($user) {                      
            $token = $user->createToken('Personal')->accessToken;
            return response([
                'message' => 'User created successfully',                
                'user' => $user,                
                'token' => $token
            ], 201);
        } else {
            return response(['error' => 'Can\'t add user'], 400);
        }
    }
}