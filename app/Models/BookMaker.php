<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookMaker extends Model
{
    protected $guarded = [];
    /** @use HasFactory<\Database\Factories\BookMakerFactory> */
    use HasFactory;
    const ROLE_AUTHOR       = 1;//作者
    const ROLE_EDITOR       = 2;//编辑
    const ROLE_TRANSLATOR   = 3;//譯者
    const ROLE_ILLUSTRATOR  = 4;//繪者
}
