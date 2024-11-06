<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory;
    public function books(){
        return $this->belongsToMany(Book::class,'book_author');
    }
}
