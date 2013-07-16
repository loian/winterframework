<?php

namespace Winter\Component\Session;

use Winter\Component\Http\Session\Interfaces\SessionInterface;

/**
 * Wrapper class for php session
 *
 * @author Lorenzo Iannone
 */
class Session implements SessionInterface{
    
    /** @var \SessionHandlerInterface  */
    protected $saveHandler;
    
    
    /**
     * Default session constructor.
     * Set the session handler.
     * @param \SessionHandlerInterface $handler
     */
    public function __construct(\SessionHandlerInterface $handler) {
        
        //store the save handler
        $this->saveHandler = $handler;
        
        //set the right session save handler 
        if (version_compare(phpversion(), '5.4.0', '>=')) {
            session_set_save_handler($this->saveHandler, false);
        } else {
            session_set_save_handler(
                array($this->saveHandler, 'open'),
                array($this->saveHandler, 'close'),
                array($this->saveHandler, 'read'),
                array($this->saveHandler, 'write'),
                array($this->saveHandler, 'destroy'),
                array($this->saveHandler, 'gc')
            );
        }

    }
    
    
    public function clear() {
        
    }

    public function get($key) {
        
    }

    public function getAll() {
        
    }

    public function getId() {
        
    }

    public function getKeys() {
        
    }

    public function hasKey($key) {
        
    }

    public function invalidate() {
        
    }

    public function regenerateId() {
        
    }

    public function remove($key) {
        
    }

    public function set($key, $value) {
        
    }

    public function setId() {
        
    }

    public function start() {
        session_start();
    }
}
