<?php

namespace Winter\Component\Http\Parameters\Exception;

/**
 * ParameterNotFoundException
 *
 * @author Lorenzo Iannone
 */
class ParameterNotFoundException extends \RuntimeException {

    public function __construct($message = null, \Exception $previous = null, $code = 0) {

        parent::__construct($message, $code, $previous);
    }

}