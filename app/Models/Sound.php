<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sound extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title', 'user_id', 'description'
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Categories() {
        return $this->belongsToMany(Category::class, 'sounds_categories','sound_id','category_id');
    }

}
