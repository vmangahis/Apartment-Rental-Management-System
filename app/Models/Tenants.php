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
        'middle_name',
        'email',
        'age',
        'mobile',
        'rent_date',
        'rental_status',
        'image_name',
        'balance_due',
        'room_id'
    ];

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }




}
