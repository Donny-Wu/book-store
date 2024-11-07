<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ChanelMomoImport implements ToCollection
{
    private $collection;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        $this->collection = $collection;
    }
    public function get(){
        return $this->collection;
    }
}
