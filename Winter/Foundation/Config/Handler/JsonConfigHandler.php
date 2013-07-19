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
    
    /**
     * Decode a json stream into object
     * 
     * @param string $encodedText
     * @return stdClass
     * @throws ParseError
     */
    public function decode($encodedText) {
        $config = json_decode($encodedText);
        if ($config == null) {
            throw new ParseError();
        }
        return $config;
    }

    /**
     * Encode an object into json stream
     * 
     * @param stdClass $decodedObject
     * @return string
     * @throws ParseError
     */
    public function encode($decodedObject) {
        $encodedConfig = json_encode($decodedObject, JSON_PRETTY_PRINT);
        if(!$encodedConfig) {
            throw new ParseError();
        }
        
        return $encodedConfig; 
    }
}