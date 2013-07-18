<?php

namespace Winter\Foundation\Config\Exception;

/**
 * @author Lorenzo Iannone
 */
class ConfigNotReadable extends \RuntimeException {

    public function __construct($message = null, \Exception $previous = null, $code = 0) {

        parent::__construct($message, $code, $previous);
    }

}

?>
