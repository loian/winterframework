<?php

namespace Winter\Component\Http\Request;

use Winter\Component\Http\Parameter\ParameterContainer;

/**
 * Http Request wrapper
 *
 * @author Lorenzo Iannone
 */
class HttpRequest {

    /**
     * @var Winter\Component\Http\Parameter\ParameterContainer;
     */
    protected $getParams;

    /**
     * @var Winter\Component\Http\Parameter\ParameterContainer;
     */
    protected $postParams;

    /**
     * @var Winter\Component\Http\Parameter\ParameterContainer;
     */
    protected $serverParams;

    /**
     * Default http Request constructor
     */
    public function __construct() {
        $this->getParams = new ParameterContainer($_GET);
        $this->postParams = new ParameterContainer($_POST);
        $this->serverParams = new ParameterContainer($_SERVER);
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
     * @return Winter\Component\Http\Parameter\ParameterContainer
     */
    public function getGet() {
        return $this->getParams;
    }

    /**
     * get Post parameters
     * 
     * @return Winter\Component\Http\Parameter\ParameterContainer
     */
    public function getPost() {
        return $this->postParams;
    }

    /**
     * @return Winter\Component\Http\Parameter\ParameterContainer
     */
    public function getServer() {
        return $this->serverParams;
    }

}