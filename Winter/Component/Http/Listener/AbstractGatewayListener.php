<?php
namespace Winter\Component\Gateway\Listener;

use Winter\Foundation\Listener\AbstractListener;
use Winter\Component\Http\Request\Request;

/**
 * AbstractGatewayListener 
 * Raise events listened by application controllers
 *
 * @author lorenzo
 */
abstract class AbstractGatewayListener extends AbstractListener {
    
    /**
     * @var \Winter\Component\Http\Request\Request 
     */
    protected $request;
    
    /**
     * Default Abstract Gateway Listener
     */
    public function __construct() {
        $this->request = new Request();
    }
    
    /**
     * Build an url from an httpRequest
     * 
     * @param \Winter\Component\Http\Request\Request $request | null
     * @return string
     */
    public function generateUrlFromRequest(Request $request = null) {
        return 'this is an url';
    }    
}
