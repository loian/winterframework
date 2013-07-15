<?php

namespace Winter\Foundation\Dispatcher\Exception;

/**
 * @author Lorenzo Iannone
 */
class EnvConfigNotFound extends \RuntimeException {

    public function __construct($message = null, \Exception $previous = null, $code = 0) {
        parent::__construct($message, $code, $previous);
    }

}

?>
