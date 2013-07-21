<?php

namespace Winter\Component\Http\Parameter\Interfaces;

/**
 * Every class implementing this interface became a session manager
 * @author Lorenzo Iannone
 */

interface ParameterContainerInterface {

   
    
   
   
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
    
    /**
     * Return all parameters
     */
    public function getAll();

}
