<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rooms extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['room_id',
    'status',
    'tenant_id',
    ];
}
