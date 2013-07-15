<?php

namespace Winter\Foundation\Event;

use Winter\Foundation\Event\Interfaces\EventInterface;

/**
 * The raw event. Every Winter event shoud extends this class
 * or implement Interfaces\EventIntefaces.
 * @author Lorenzo Iannone
 */
abstract class AbstractEvent implements EventInterface {

    /**
     * The name of the event
     * @var string 
     */
    protected $identifier;

    /**
     * A key=>value array containg all arguments of the event
     * @var array 
     */
    protected $arguments;

    /**
     * Default event constructor
     * @param array $arguments  A key=>value array containg all arguments of the event
     */
    public function __construct() {
        $this->generateIdentifier();
    }

    /**
     * Generate a unique identifier
     */
    protected function generateIdentifier() {
        //generate an unique id for the event
        $this->identifier = rand();
    }

    /**
     * Returns the identifier of the event
     */
    public function getIdentifier() {
        return $this->identifier;
    }

}