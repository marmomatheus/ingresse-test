<?php

namespace App\Http\Controllers\Api;

use App\User as UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

     /**
     * Lista todos os usuários cadastrados
     * @param  \App\Repositories\UserRepository $userRepository
     * @return \App\User
     */
    public function index(UserRepository $userRepository)
    {
        $users = $userRepository->getAll();
        return $users;
    }

     /**
     * Mostra um usuário especifico
     * @param  \App\Repositories\UserRepository $userRepository
     * @param  int  $id Id do usuário que deve ser mostrado
     * @return \App\User
     */
    public function show(UserRepository $userRepository, $id)
    {
        return $userRepository->get($id);
    }

      /**
     * Salva um novo usuário
     * @param  \App\Http\Requests\UserRequest $userRequest
     * @param  \App\Repositories\UserRepository $userRepository
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $userRequest, UserRepository $userRepository)
    {
        $user = $userRepository->save($userRequest);
        if ($user) {
            return response([
                'message' => 'Success!',
                'user' => $user
            ], 201);
        } else {
            return response([
                'error' => 'Can\'t add user'
            ], 400);
        }
    }

    /**
     * Edita um usuário existente
     * @param  \App\Http\Requests\UserRequest $userRequest
     * @param  \App\Repositories\UserRepository $userRepository
     * @param  int  $id Id do usuário que deve ser editado
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $userRequest, UserRepository $userRepository, $id)
    {
        $user = $userRepository->save($userRequest, $id);
        if ($user) {
            return response([
                'message' => 'Success!',
                'user' => $user
            ], 201);
        } else {
            return response([
                'error' => 'Can\'t update user'
            ], 400);
        }
    }
    
    /**
     * Deleta um usuário existente
     * @param  \App\Repositories\UserRepository $userRepository
     * @param  int  $id Id do usuário que deve ser deletado
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRepository $userRepository, $id)
    {
        if ($userRepository->delete($id)) {
            return response([], 204);
        } else {
            return response(['error' => 'Can\'t delete user'], 400);
        }
    }
}
