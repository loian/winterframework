<?php

namespace Winter\Component\Http\Parameters\Container;

use Winter\Component\Http\Parameters\Exception\ParameterNotFoundException;

/**
 * A container for _GET, _POST, COOKIE etc..
 *
 * @author Lorenzo Iannone
 */
class ParametersContainer {

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

}
