<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

        /**
    * @var array
    */
    protected $fillable = [
        'company_name',
        'company_name_kana',
        'address',
        'tel',
        'representative',
        'representative_kana'
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];
}
