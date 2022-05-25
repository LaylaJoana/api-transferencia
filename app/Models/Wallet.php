<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Wallet extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_user','balance'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */


    public function deleteById(int $id) {

        $deleted  = DB::table('wallets')->where('id', $id)->delete();

        return $deleted ;
    }
    
    public function updateWallet(int $idUser, float $walletBalance) {

        $wallet = DB::table('wallets')
                ->where('id_user', $idUser)
                ->update(
                    ['balance' => $walletBalance]
                );

        return $wallet;
    }

}
