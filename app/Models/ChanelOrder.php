<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChanelOrder extends Model
{
    /** @use HasFactory<\Database\Factories\ChanelOrderFactory> */
    use HasFactory;
    protected $guarded = [];
    public function chanel_company(){
        return $this->belongsTo(ChanelCompany::class);
    }

}
