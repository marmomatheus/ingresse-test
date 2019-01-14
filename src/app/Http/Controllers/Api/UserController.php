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

    public function index()
    {
        return UserModel::all();
    }

    public function show($id)
    {
        return UserModel::findOrFail($id);
    }

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

    public function destroy(UserRepository $userRepository, $id)
    {
        if ($userRepository->delete($id)) {
            return response([], 204);
        } else {
            return response(['error' => 'Can\'t delete user'], 400);
        }
    }
}
