<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {
    protected $fillable = ['user_id','path'];
    protected $appends = ['url'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    
      public function getUrlAttribute()
    {
        return url('storage/' . $this->path);
    }
}
