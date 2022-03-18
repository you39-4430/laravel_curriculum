<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

            /**
    * @var array
    */
    protected $fillable = [
        'billing_id',
        'billing_name',
        'billing_name_kana',
        'address',
        'tel',
        'department',
        'billing_address',
        'billing_address_kana'
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
