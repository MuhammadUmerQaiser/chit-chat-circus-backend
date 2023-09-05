<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;

class AuthController extends Controller
{
    protected $user;
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function register(RegisterUserRequest $request){
        try {
            return $this->user->addUser($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occured, ' . $e->getMessage(), 'status' => 401], 401);
        }
    }

    public function login(LoginUserRequest $request){
        try {
            return $this->user->loginUser($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occured, ' . $e->getMessage(), 'status' => 401], 401);
        }
    }
}
