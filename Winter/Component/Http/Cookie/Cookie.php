<?php

namespace Winter\Component\Http\Cookie;

use Winter\Component\Http\Parameter\ParameterContainer;
use Winter\Component\Http\Parameter\Interfaces\ParameterContainerInterface;
use Winter\Component\Http\Parameter\ParameterContainer;

/**
 * Cookie
 *
 * @author Lorenzo Iannone
 */
class Cookie extends ParameterContainer implements ParameterContainerInterface {

    public function __construct() {
        parent::__construct($_COOKIE);
    }

    /**
     * Set a cookie
     * 
     * @param string $key
     * @param string $value
     * @param integer $expire
     * @param string $domain
     * @param boolean $secure
     * @param boolean $httponly
     */
    public function set($key, $value, $expire = 0, $domain = null, $secure = false, $httponly = false) {
        
        setcookie($key, $value, $expire, $path, $domain, $secure, $httponly);
    }

    /**
     * Remove a cookie
     * 
     * @param string $key
     * @throws ParameterNotFoundException
     */
    public function remove($key) {
        if (!key_exists($key, $this->parameters)) {
            throw new ParameterNotFoundException();
        }
        unset($this->parameters[$key]);
        setcookie($key, '', time() - 3600); // empty value and old timestamp
    }
    
    /**
     * Clear all cookies
     */
    public function clear() {
        foreach ($_COOKIE as $key=>$value) {
            $this->remove($key);
        }
    }

}
