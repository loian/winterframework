<?php

namespace Winter\Component\Http\Parameter;

use Winter\Component\Http\Parameter\Exception\ParameterNotFoundException;
use Winter\Component\Http\Parameter\Interfaces\ParameterContainerInterface;


/**
 * A container for _GET, _POST, COOKIE etc..
 *
 * @author Lorenzo Iannone
 */
class ParameterContainer implements ParameterContainerInterface {

    /**
     * @var array
     */
    protected $parameters;

    /**
     * * Default ParametersContainer constructor
     * @param array $params
     */
    public function __construct($params) {
        $this->parameters = $params;
    }

    /**
     * Set a key value pair in the container
     * @param string $key
     */
    public function set($key, $value) {
        $this->parameters['key'] = $value;
    }

    /**
     * Get a parameter
     * @param string $key
     * @return mixed
     * @throws ParameterNotFoundException
     */
    public function get($key) {
        if (!key_exists($key, $this->parameters)) {
            throw new ParameterNotFoundException();
        }
        return $this->parameters['key'];
    }

    public function getAll() {
        return $this->parameters;
    }

    public function getKeys() {
        return array_keys($this->parameters);
    }

    public function hasKey($key) {
        if(array_key_exists($key, $this->parameters)) {
            return true;
        }
        
        return false;
    }

    public function remove($key) {
        unset ($this->parameters[$key]);
    }



}
