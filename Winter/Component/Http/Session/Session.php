<?php

namespace Winter\Component\Http\Session;

use Winter\Component\Http\Session\Interfaces\SessionInterface;
use Winter\Component\Http\Parameter\Exception\ParameterNotFoundException;

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
        $_SESSION = array();
    }

    public function get($key) {
        if (!key_exists($key, $_SESSION)) {
            throw new ParameterNotFoundException();
        }
        return $_SESSION[$key];
    }

    public function getAll() {
        return $_SESSION;
    }

    public function getId() {
        return session_id();
    }

    public function getKeys() {
        return array_keys($_SESSION);
    }

    public function hasKey($key) {
        return array_key_exists($key, $_SESSION);
    }

    public function invalidate() {
        unset ($_SESSION);
    }

    public function regenerateId() {
        session_regenerate_id();
    }

    public function remove($key) {
        if (!key_exists($key, $_SESSION[$key])) {
            throw new ParameterNotFoundException();
        }

        unset ($_SESSION[$key]);
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function setId($id) {
        session_id($id);
    }

    public function start() {
        session_start();
    }
}
