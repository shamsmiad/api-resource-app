<?php

namespace App\Models;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['user_id','book_id','rating'];

    public function book(){
        $this->belongsTo(Book::class);
    }
}
