<?php

namespace App\Models;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','description','user_id'];
    
    public function user (){
        return $this->belongsTo(User::class);
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }
}
