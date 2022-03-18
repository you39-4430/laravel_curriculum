<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billings extends Model
{
    use HasFactory;

            /**
    * @var array
    */
    protected $fillable = [
        'billing_name',
        'billing_name_kana',
        'address',
        'tel',
        'department',
        'billing_address'
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
