<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Landlord extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id', 'surname', 'firstname', 'middlename',
        'age', 'zip_code', 'address_1', 'address_2', 'city', 'state', 'image'
    ];
}
