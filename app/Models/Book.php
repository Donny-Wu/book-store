<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $guarded = [];
    public function publisher(){
        $this->hasOne(Publisher::class);
    }
    public function language(){
        $this->hasOne(Language::class);
    }
}
