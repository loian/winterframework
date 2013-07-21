<?php

namespace Winter\Component\Http\Session\Interfaces;
use Winter\Component\Http\Parameter\Interfaces\ParameterContainerInterface;

/**
 * Every class implementing this interface became a session manager
 * @author Lorenzo Iannone
 */

interface SessionInterface extends ParameterContainerInterface {

    /**
     * Start a session
     */
    public function start();
    
    /**
     * Destory a session
     */
    public function invalidate();
    
    /**
     * Get the session id
     */
    public function getId();
    
    /**
     * Set the session id
     */
    public function setId($id);
    
    /**
     * Regenerate session id
     */
    public function regenerateId();
    

    /**
     * Clear the session 
     */
    public function clear();
    
}
