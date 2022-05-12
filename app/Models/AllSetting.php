<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllSetting extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * @var array
    */
    protected $fillable = [
        'company_name',
        'company_name_kana',
        'address',
        'tel',
        'representative',
        'representative_kana',
        'company_id',
        'billing_name',
        'billing_name_kana',
        'billing_address',
        'billing_tel',
        'department',
        'registered_person',
        'registered_person_kana'
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
