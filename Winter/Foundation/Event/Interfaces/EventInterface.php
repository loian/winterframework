<?php

namespace Winter\Foundation\Event\Interfaces;

/**
 * @author Lorenzo Iannone
 */

/**
 * Every event object must implement this interface
 */
interface EventInterface {

    /**
     * Get the content of an Event
     * return mixed
     */
    public function getContent();

    /**
     * Get the unique identifier of an event object
     * @return string
     */
    public function getIdentifier();
}