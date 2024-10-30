<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
trait HasDataResponse{
    private $responseValues = [
        'code'       => Response::HTTP_OK,
        'message'    => '',
        'data'       => []
    ];
    public function response(...$args){
        // dd($args);
        $reponseHandles = [
            function($code){return $this->isValidCode($code);},
            function($message){return is_string($message)&&trim($message)!='';},
            function($data){return isset($data);},
        ];
        $response = $this->responseValues;
        $responseKeys = array_keys($response);
        foreach($args as $index => $value){
            if(is_callable($reponseHandles[$index])&&$reponseHandles[$index]($value)){
                $response[$responseKeys[$index]] = $value;
            }
        }
        // dd($response);
        return $response;
    }
    public function isValidCode($code){
        return array_key_exists($code,Response::$statusTexts);
    }
}
