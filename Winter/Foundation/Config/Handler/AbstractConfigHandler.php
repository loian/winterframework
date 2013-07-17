<?php
namespace Winter\Foundation\Config\Handler;

use Winter\Foundation\Config\Handler\Interfaces\ConfigHandlerInterface;

/**
 * Base class of all config handlers
 *
 * @author Lorenzo Iannone
 */
abstract class AbstractConfigHandler implements ConfigHandlerInterface {
    
    abstract public function read($filePath);

    abstract public function write($config, $filePath);
    
    /**
     * Check if path of config file exists
     * @param string $filePath
     * @return boolean
     */
    protected  function checkPath($filePath) {
        return true;
    }
}

?>
