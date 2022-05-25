<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type','name', 'email','document','password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];


    public function UserById(int $id) {
        $users = DB::table('users')->where('id', $id)->get();
        return $users;
    }

    public function updateByd(array $usuario, int $id) {

        $user = DB::table('users')
                ->where('id', $id)
                ->update(
                    [ 'type' =>  $usuario['type'],
                    'name' =>  $usuario['name'],
                    'email' => $usuario['email'],
                    'document' =>  $usuario['document'],
                    'password' =>  $usuario['password']

                    ]
                );

        return $user;
    }

    public function deleteById(int $id) {

        $deleted  = DB::table('users')->where('id', $id)->delete();

        return $deleted ;
    }
}
