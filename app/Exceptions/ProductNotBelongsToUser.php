<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongsToUser extends Exception
{
    public function render(){
    	return ['errors' => 'This content not belong to yours so can\'t be delete and update'];
    }
}
