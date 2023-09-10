<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getAllUser(Request $request){
        try {
            return $this->user->getAllUser($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occured, ' . $e->getMessage(), 'status' => 401], 401);
        }
    }
}
