<?php
namespace Winter\Foundation\Config\Handler\Exception;


/**
 * @author Lorenzo Iannone
 */
class FileNotFound extends \RuntimeException {

    public function __construct($message = null, \Exception $previous = null, $code = 0) {

        parent::__construct($message, $code, $previous);
    }

}

?>
