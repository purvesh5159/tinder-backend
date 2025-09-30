<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Model {
    protected $fillable = ['name','age','latitude','longitude'];
    public function photos() {
        return $this->hasMany(Photo::class);
    }

    public function swipesGiven()
    {
        return $this->hasMany(Swipe::class, 'user_id');
    }

    public function swipesReceived()
    {
        return $this->hasMany(Swipe::class, 'target_user_id');
    }
}

