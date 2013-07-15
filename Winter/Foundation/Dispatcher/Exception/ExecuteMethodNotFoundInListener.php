<?php

namespace Winter\Foundation\Dispatcher\Exception;
/**
 * Thrown when an annotation of @condition poit to a non-existent method
 *
 * @author Lorenzo Iannone
 */
class ExecuteMethodNotFoundInListener extends \RuntimeException{

    public function __construct($message = null, \Exception $previous = null, $code = 0) {
        parent::__construct($message, $code, $previous);
    }

}

