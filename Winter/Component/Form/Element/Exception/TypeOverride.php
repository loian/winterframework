<?php

namespace Winter\Component\Form\Element\Exception;

/**
 * ParameterNotFoundException
 *
 * @author Lorenzo Iannone
 */
class TypeOverride extends \RuntimeException {

    public function __construct($message = null, \Exception $previous = null, $code = 0) {

        parent::__construct($message, $code, $previous);
    }

}