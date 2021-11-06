<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoundsCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        "sound_id", "category_id"
    ];
    public $timestamps = false;
}
