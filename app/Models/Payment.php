<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'transaction_id',
        'tenant_id',
        'amount_paid',
        'transaction_date'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenants::class);
    }

}
