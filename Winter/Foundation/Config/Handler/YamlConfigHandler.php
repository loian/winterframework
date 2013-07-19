<?php

namespace Winter\Foundation\Config\Handler;

use Winter\Foundation\Config\Handler\AbstractConfigHandler;
use Winter\Foundation\Config\Handler\Exception\ParseError;

/**
 * Manage Yaml configuration files
 *
 * @author Lorenzo Iannone
 */
class YamlConfigHandler extends AbstractConfigHandler {
    
    /**
     * Decode a yaml stream to an object
     * @param type $encodedText
     * @return stdClass
     * @throws ParseError
     */
    public function decode($encodedText) {
        $config = yaml_parse($encodedText);

        if (!$config ) {
            throw new ParseError();
        }
        
        //convert to object passing by json 
        $config = json_decode(json_encode($config, JSON_FORCE_OBJECT));
        return $config;
    }

    
    public function encode($decodedObject) {
        $encodedConfig = yaml_emit((array)$decodedObject);
        
        if(!$encodedConfig) {
            throw new ParseError();
        }
        
        return $encodedConfig;         
    }    
}