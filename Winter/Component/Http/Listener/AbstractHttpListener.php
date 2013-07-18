<?php
namespace Winter\Component\Http\Listener;

use Winter\Foundation\Listener\AbstractListener;
use Winter\Component\Http\Request\HttpRequest;

/**
 * AbstractGatewayListener 
 * Raise events listened by application controllers
 *
 * @author Lorenzo Iannone
 */
abstract class AbstractHttpListener extends AbstractListener {
    
    /**
     * @var \Winter\Component\Http\Request\Request 
     */
    protected $request;
    
    /**
     * Default Abstract Gateway Listener
     */
    public function __construct() {
        $this->request = new HttpRequest();
    }
    
    /**
     * Build an url from an httpRequest
     * 
     * @param \Winter\Component\Http\Request\HttpRequest $request | null
     * @return string
     */
    public function generateUrlFromRequest(HttpRequest $request = null) {
        return 'this is an url';
    }    
}
