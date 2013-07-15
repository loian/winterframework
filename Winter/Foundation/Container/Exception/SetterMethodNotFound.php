<?php

namespace Winter\Foundation\Container\Exception;

/**
 * Description of EnvConfigNotFoundException
 *
 * @author Lorenzo Iannone
 */
class SetterMethodNotFound extends \RuntimeException {

    public function __construct($message = null, \Exception $previous = null, $code = 0) {
        parent::__construct($message, $code, $previous);
    }

}

?>
