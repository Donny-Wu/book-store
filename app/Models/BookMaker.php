<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookMaker extends Model
{
    protected $guarded = [];
    /** @use HasFactory<\Database\Factories\BookMakerFactory> */
    use HasFactory;
}
