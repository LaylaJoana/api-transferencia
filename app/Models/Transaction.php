<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
  use  HasFactory, SoftDeletes;

    protected $fillable = [
        'id_user_from',
        'id_user_to',
        'value'
    ];

}
