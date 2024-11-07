<?php
namespace App\Services;
use App\Interface\ChanelInterface;
use App\Enum\Chanel;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Illuminate\Support\Collection;
use App\Imports\ChanelEliteImport;
use Carbon\Carbon;
use App\Models\ChanelOrder;
class EliteService implements ChanelInterface{
    private Collection $data;
    public function __construct(){
        $this->data = new Collection;
    }
    /**
     * Summary of fetchData
     * @return void
     */
    public function fetchData(){
        $this->data = new Collection;
        $files = Storage::disk('local')->allFiles('chanels/'.Chanel::ELITE->value);
        foreach($files as $path){
            $import = new ChanelEliteImport();
            Excel::import($import, $path, null, \Maatwebsite\Excel\Excel::XLSX);
            // dd($import->get());
            $this->data->push($import->get()->toArray());
            // dd($this->data);
            Storage::delete($path);
        }
        // dd($this->data);
        // dd($files);
    }
    /**
     * Summary of processData
     * @return void
     */
    public function processData(){
        // dd(' processData',$this->data);
        $columns = [
            'channel_order_no',
            'isbn',
            'product_name',
            'product_qty',
            'product_price',
        ];
        // flatMap
        $this->data =$this->data->flatMap(function($rowArray)use($columns){
            // dd($row);
            $ship_address   = $rowArray[1][2];
            $contact_phone  = $rowArray[2][2];
            $contact_person = $rowArray[3][2];
            $rowArray       = array_slice($rowArray, 7);
            $newRowArray    = [];
            foreach($rowArray as $row){
                array_shift($row);
                $newRow = [];
                foreach($columns as $index=>$column){
                    $newRow[$column] = trim($row[$index]);
                }
                $newRow['ship_address']         = $ship_address;
                $newRow['contact_phone']        = $contact_phone;
                $newRow['contact_person']       = $contact_person;
                $newRow['chanel_company_id']    = 1;
                $newRow['order_date']           = Carbon::today();
                $newRow['total_price']          = $newRow['product_qty'] * $newRow['product_price'];
                $newRow['created_at']           = Carbon::now();
                $newRowArray[]                  = $newRow;
            }
            return $newRowArray;
            // dd( $newRowArray);
        });
        // dd($this->data);
    }
    /**
     * Summary of writeData
     * @return void
     */
    public function writeData(){
        ChanelOrder::insert($this->data->toArray());
    }
}
