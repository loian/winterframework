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

    /**
     * Decode a text into an object
     * @param string $encodedText
     * @return object
     */
    public function decode($encodedText);

    /**
     * Encode an object into a text
     * @param object $decodedObject
     * @return string
     */
    public function encode($decodedObject);
}

