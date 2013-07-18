<?php
namespace Winter\Foundation\Config\Handler;

use Winter\Foundation\Config\Handler\AbstractConfigHandler;
use Winter\Foundation\Config\Handler\Exception\ParseError;

/**
 * Manage Json configuration files
 *
 * @author Lorenzo Iannone
 */
class JsonConfigHandler extends AbstractConfigHandler {
 
    public function decode($encodedText) {
        $config = json_decode($encodedText);
        if ($config == null) {
            throw new ParseError();
        }
        return $config;
    }

    public function encode($decodedObject) {
        $encodedConfig = json_encode($decodedObject, JSON_PRETTY_PRINT);
        if(!$encodedConfig) {
            throw new ParseError();
        }
        
        return $encodedConfig; 
    }
}