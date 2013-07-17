<?php
namespace Winter\Foundation\Config\Handler;

use Winter\Foundation\Config\Handler\AbstractConfigHandler;
use Winter\Foundation\Config\Handler\Exception\FileNotFound;
use Winter\Foundation\Config\Handler\Exception\ParseError;

/**
 * Manage Json configuration files
 *
 * @author Lorenzo Iannone
 */
class JsonConfigHandler extends AbstractConfigHandler {
 
    public function read($filePath) {
        if(!file_exists($filePath)) {
            throw new FileNotFound("{$filePath} not found.");
        }
        
        $conf = json_decode(file_get_contents($filePath));
        
        if ($conf==null) {
            throw new ParseError();
        }
        
        return $conf;
    }

    public function write($config, $filePath) {
        
    }    
}