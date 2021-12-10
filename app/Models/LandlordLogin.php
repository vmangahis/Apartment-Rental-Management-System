<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LandlordLogin extends Authenticatable
{
    use HasFactory;

    public $table = 'landlord_login';
    public $timestamps = false;

    protected $fillable = ['id','username', 'password'
    ];

}
