<?php
namespace App\Services;
use App\Interface\ChanelInterface;
use App\Enum\Chanel;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use App\Imports\ChanelMomoImport;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Models\ChanelOrder;
class MomoService implements ChanelInterface{
    private Collection $data;
    public function __construct(){
        $this->data = new Collection;
    }
    public function fetchData(){
        $files = Storage::disk('local')->allFiles('chanels/'.Chanel::MOMO->value);
        foreach($files as $path){
            $momoImport = new ChanelMomoImport();
            Excel::import($momoImport, $path, null, \Maatwebsite\Excel\Excel::CSV);
            $this->data = $this->data->merge($momoImport->get()->toArray());
            Storage::delete($path);
            // dd($this->data,$momoImport->get());
            // dd($momoImport->get());
        }
        // dd($files);
    }
    public function processData(){
        // dd('momo processData',$this->data);
        $columns = [
            'channel_order_no',
            'order_date',
            'isbn',
            'product_name',
            'product_qty',
            'product_price',
            'ship_address',
            'contact_phone',
            'contact_person'
        ];
        $this->data = $this->data->map(function($row)use($columns){
            $newRow = [];
            foreach($columns as $index=>$column){
                $newRow[$column] = $row[$index];
            }
            $newRow['chanel_company_id']    = 2;
            $newRow['order_date']           = Carbon::today();
            $newRow['total_price']          = $newRow['product_qty'] * $newRow['product_price'];
            // $newRow['create_at']            = Carbon::now();
            return $newRow;
        });
        // dd('momo processData',$this->data);
    }
    public function writeData(){
        // dd('momo writeData',$this->data->toArray());
        ChanelOrder::insert($this->data->toArray());
    }
}
