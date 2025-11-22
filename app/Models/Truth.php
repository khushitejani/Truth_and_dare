<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truth extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'question',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'type'); 
    }
}
