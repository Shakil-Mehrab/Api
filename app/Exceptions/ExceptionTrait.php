<?php

namespace App\Exceptions;

use Exception;
use illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait{
  public function apiException($request,$e)
    {
        if($this->isModel($e)){
            return $this->ModelResponse($e);
        }
        if($this->isHttp($e)){
            return response()->json([
                "errors"=>"Incorrect Route"
            ],Response::HTTP_NOT_FOUND);
        }
        return parent::render($request, $e);
    }
    public function isModel($e){
        return $e instanceof ModelNotFoundException;
    }
    public function isHttp($e){
        return $e instanceof NotFoundHttpException;
    }
    public function ModelResponse($e){
        return response()->json([
            "errors"=>"Product Model Not Found"
        ],Response::HTTP_NOT_FOUND);
    }
}
