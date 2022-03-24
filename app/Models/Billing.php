<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * @var array
    */
    protected $fillable = [
        'company_id',
        'billing_name',
        'billing_name_kana',
        'billing_address',
        'billing_tel',
        'department',
        'billing_address_name',
        'billing_address_name_kana'
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
