<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_image(){
        return $this->belongsTo(UserImage::class);
    }

    public function getUserByEmail($email){
        return $this->where('email', $email)->first();
    }

    public function getUserById($id){
        return $this->find($id);
    }

    public function addUser(Request $request) {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = Hash::make($request->password);
        $this->user_image_id = $request->user_image_id;
        $this->email_verified_at = now();
        $this->save();

        return response()->json(['data' => new UserResource($this), 'message' => 'User registered successfully', 'status' => 200], 200);
    }

    public function loginUser(Request $request) {
        $user = $this->getUserByEmail($request->email);

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['data' => null, 'message' => 'Provided credentials is incorrect', 'status' => 401], 401);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $checkLastAttemptedUser = Auth::getLastAttempted();
            Auth::login($checkLastAttemptedUser);
            $token = Auth::user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token, 'data' => new UserResource(Auth::user()), 'message' => 'User logged in successfully', 'status' => 200], 200);
        }

        return response()->json(['data' => null, 'message' => 'Invalid details', 'status' => 401], 401);
    }
}
