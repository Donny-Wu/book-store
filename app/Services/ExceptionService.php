<?php
namespace App\Services;
use App\Traits\HasApiResponse;
use Throwable;
class ExceptionService
{
    use HasApiResponse;
    protected $exception_path = null;
    public function __construct($path=null)
    {
        $this->exception_path = $path;
    }
    public function render($request, Throwable $e){
        // dd($e);
        $files = $this->getFiles();
        // dd('test_file');
        foreach($files as $exception_name){
            if(class_basename($e)==$exception_name){
                $exception = eval('return new \App\Exceptions\\'.$exception_name.';');
                return $exception->render($request);
            }
        }
        // dd($e,$e->getCode());
        if($this->isValidCode($e->getCode())){
            return $this->apiResponse($e->getCode(),$e->getMessage());
        }
        return null;
        // return $e;
        // return $this->apiError($e->getMessage());

    }
    public function getFiles(){
        // $path = __DIR__;
        $path = $this->exception_path;
        // dd($path);
        $fileNames = [];
        $files = \File::allFiles($path);
        foreach($files as $file) {
            array_push($fileNames, pathinfo($file)['filename']);
        }
        return $fileNames;
        // dd($fileNames);
    }
    public function getException(Throwable $e){
        $files = $this->getFiles();
        // dd('test_file');
        foreach($files as $exception_name){
            if($exception_name == 'ExceptionHandler'){
                continue;
            }
            if(class_basename($e)==$exception_name){
                $exception = eval('return new \App\Exceptions\\'.$exception_name.';');
                return $exception;
            }
        }
        return $e;
    }
}
