<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['name'];
    public function Sounds() {
        return $this->belongsToMany(Sound::class,'sounds_categories','category_id','sound_id');
    }
}
