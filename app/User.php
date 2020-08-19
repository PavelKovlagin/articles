<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    protected static function selectUsers(){
        $users = DB::table('users')
        ->select(
            'users.id as user_id',
            'users.name as user_name',
            'users.surname as user_surname',
            'users.address as user_address',
            'users.email as user_email'
        );
        return $users;
    }

    protected static function selectUser($user_id){
        $user = User::selectUsers()
        ->where('id', '=', $user_id);
        return $user;
    }

    protected static function selectAuthUser(){
        if (Auth::check()) {
            return User::selectUser(Auth::user()->id)->first();
        } else {
            return false;
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
