<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait {

	public function apiException($request,$e){

		if($this->incorrectUrl($e)){
            return $this->httpResponse($e);
        }

        if($this->isModel($e)){
            return $this->modelResponse($e);
        }
        
        return parent::render($request, $e);

	}

	protected function modelResponse($e){
		return response()->json([
                'errors' => 'Your model doesn\'t contain data'
            ],Response::HTTP_NOT_FOUND);
	}

	protected function isModel($e){
		return $e instanceof ModelNotFoundException;
	}

	protected function httpResponse($e){
		return response()->json([
                'errors' => 'Incorrect url or query url'
            ],Response::HTTP_NOT_FOUND);
	}

	protected function incorrectUrl($e){
		return $e instanceof NotFoundHttpException;
	}


}