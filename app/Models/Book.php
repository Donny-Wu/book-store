<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;
    //
    protected $guarded = [];
    public function authors(){
        return $this->belongsToMany(Author::class,'book_author');
    }

    public function getShortTitleAttribute(){
        return Str::limit($this->title, 80, '...');
        // return substr($this->title, 0, 20);
    }
    public function publisher(){
        // $this->hasOne(Publisher::class);
        return $this->belongsTo(Publisher::class);
    }
    public function language(){
        return $this->belongsTo(Language::class);
        // $this->hasOne(Language::class);
    }
    public function getPublisherNameAttribute(){
        return $this->publisher->name;
    }
    public function getLanguageNameAttribute(){
        return $this->language->name;
    }
}
