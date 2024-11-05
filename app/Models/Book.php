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

    public function getShortTitleAttribute(){
        return Str::limit($this->title, 80, '...');
        // return substr($this->title, 0, 20);
    }
    public function publisher(){
        $this->hasOne(Publisher::class);
    }
    public function language(){
        $this->hasOne(Language::class);
    }
}
