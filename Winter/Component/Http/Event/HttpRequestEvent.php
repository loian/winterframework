<?php

namespace Winter\Component\Http\Event;

use Winter\Foundation\Event\AbstractEvent;
use Winter\Component\Http\Request\HttpRequest;

/**
 * The http Request
 *
 * @author Lorenzo Iannone
 */
class HttpRequestEvent extends AbstractEvent {

    protected $request;

    /**
     * Default http request event constructor
     */
    public function __construct() {
        $this->request = new HttpRequest();
        parent::__construct();
    }

    protected function generateIdentifier() {
        $this->identifier = $this->request->getUrl();
    }

    /**
     * Get the http request
     * @return Winter\Component\Http\Request\Request
     */
    public function getContent() {
        return $this->request;
    }

}
