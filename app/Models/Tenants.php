<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'surname',
        'firstname',
        'email',
        'age',
        'mobile',
        'date'
    ];


}
