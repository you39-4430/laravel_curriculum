<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
    * @var array
    */
    protected $fillable = ['title', 'content'];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at']; 
}
