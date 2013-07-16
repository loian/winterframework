<?php

namespace Winter\Component\Http\Session\Interfaces;

/**
 * Every class implementing this interface became a session manager
 * @author Lorenzo Iannone
 */

interface SessionInterface {

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
    public function setId();
    
    /**
     * Regenerate session id
     */
    public function regenerateId();
    
    /**
     * Set a value for a key in the session
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value);

    /**
     * Return a value of a key from the session
     * @param string $key
     */
    public function get($key);

    /**
     * Clear the session 
     */
    public function clear();
    
    
    /**
     * Return all session array
     */
    public function getAll();
    
    /**
     * True if session has given key
     * @param string $key
     */
    public function hasKey($key);

    /**
     * Return all keys in session
     */
    public function getKeys();

    /**
     * Delete an item from session
     * @param type $key
     */
    public function remove($key);

}
