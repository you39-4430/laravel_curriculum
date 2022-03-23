<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
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
        'representative_kana'
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($company) {
            $company->billings()->delete();
        });
    }
}

