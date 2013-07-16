<?php

namespace Winter\Component\Http\Request;

use Winter\Component\Http\Parameters\Container\ParametersContainer;

/**
 * Http Request wrapper
 *
 * @author Lorenzo Iannone
 */
class HttpRequest {

    /**
     * @var Winter\Component\Http\Parameters\Container\ParametersContainer;
     */
    protected $getParams;

    /**
     * @var Winter\Component\Http\Parameters\Container\ParametersContainer;
     */
    protected $postParams;

    /**
     * @var Winter\Component\Http\Parameters\Container\ParametersContainer;
     */
    protected $serverParams;

    /**
     * Default http Request constructor
     */
    public function __construct() {
        $this->getParams = new ParametersContainer($_GET);
        $this->postParams = new ParametersContainer($_POST);
        $this->serverParams = new ParametersContainer($_SERVER);
    }

    /**
     * Return the url of the request
     */
    public function getUrl() {
        $parts = explode("?", $_SERVER["REQUEST_URI"]);
        return $parts[0];
    }

    /**
     * get Get parameters
     * 
     * @return Winter\Component\Http\Parameters\Container\ParametersContainer
     */
    public function getGet() {
        return $this->getParams;
    }

    /**
     * get Post parameters
     * 
     * @return Winter\Component\Http\Parameters\Container\ParametersContainer
     */
    public function getPost() {
        return $this->postParams;
    }

    /**
     * @return Winter\Component\Http\Parameters\Container\ParametersContainer
     */
    public function getServer() {
        return $this->serverParams;
    }

}