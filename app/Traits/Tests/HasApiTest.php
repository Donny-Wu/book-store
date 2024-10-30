<?php
namespace App\Traits\Tests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\HasDataResponse;
use App\Facades\RouteList;
trait HasApiTest{
    use HasDataResponse;
    private $response = null;
    private $name = 'animals';

    public function getRouteList($name){
        return RouteList::get($name);
    }
    public function storeTest($formData){
        $uri = RouteList::first($this->name.'.store')->uri();
        $method = RouteList::first($this->name.'.store')->methods[0];
        $this->response = $this->json($method,$uri,$formData);
    }
    public function assertCreated($message = '',$data = []){
        $code = Response::HTTP_CREATED;
        $this->response->assertStatus($code)->assertJson($this->response($code,$message,$data));
        // $this->response($code,$message,$data);
    }
}
