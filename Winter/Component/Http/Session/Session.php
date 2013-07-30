<?php

namespace Winter\Component\Http\Session;

use Winter\Component\Http\Session\Interfaces\SessionInterface;
use Winter\Component\Http\Parameter\Exception\ParameterNotFoundException;
use Winter\Component\Http\Parameter\ParameterContainer;

/**
 * Wrapper class for php session
 *
 * @author Lorenzo Iannone
 */
class Session extends ParameterContainer implements SessionInterface{
    
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
        //start the session if necessary
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        //bint the internal param to $_SESSION;
        parent::__construct($_SESSION);

    }
    
    public function clear() {
        $this->parameters = array();
    }

    public function getId() {
        return session_id();
    }

    public function invalidate() {
        unset ($this->parameters);
    }

    public function regenerateId() {
        session_regenerate_id();
    }

    public function setId($id) {
        session_id($id);
    }

    public function start() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    
    public function close() {
        session_write_close();
    }
}
