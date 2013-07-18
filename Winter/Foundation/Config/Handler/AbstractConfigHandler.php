<?php
namespace Winter\Foundation\Config\Handler;

use Winter\Foundation\Config\Handler\Interfaces\ConfigHandlerInterface;
use Winter\Foundation\Config\Handler\Exception\FileNotFound;

/**
 * Base class of all config handlers
 *
 * @author Lorenzo Iannone
 */
abstract class AbstractConfigHandler implements ConfigHandlerInterface {

    /**
     * Read a configuration from file
     * @param string $filePath
     * @return array|object
     * @throws FileNotFound
     */
    public function read($filePath) {
        if(!file_exists($filePath)) {
            throw new FileNotFound("{$filePath} not found.");
        }
        
        return $this->decode(file_get_contents($filePath));
    }

    /**
     * Write a configuration to a file
     * @param object $config
     * @param string $filePath
     */
    public function write($config, $filePath) {
        
    }
    
}
