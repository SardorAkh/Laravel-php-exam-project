<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sound extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;


    public function User() {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'title', 'user_id'
    ];


}
