<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ChanelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    private $collection;
    public function collection(Collection $collection)
    {
        //
        $this->collection = $collection;
    }
    public function get(){
        return $this->collection;
    }
}
