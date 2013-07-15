<?php

namespace Winter\Foundation\Response\Interfaces;


/**
 * Every response object should implement this interface
 * @author lorenzo
 */
interface ResponseInterface {
    
    /**
     * Return the content of the response
     */
    public function getContent();
}

?>
