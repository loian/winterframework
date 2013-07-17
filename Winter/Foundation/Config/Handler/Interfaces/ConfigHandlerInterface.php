<?php

namespace Winter\Foundation\Config\Handler\Interfaces;
/**
 * Interface to be implemented by all config handlers
 * @author Lorenzo Iannone
 */
interface ConfigHandlerInterface {
    
    /**
     * Load a configuration file
     * @param string $filePath
     */
    public function read($filePath);
    
    /**
     * Store config into a file
     * @param array config
     * @param string filePath
     */
    public function write($config, $filePath);
}


