<?php

namespace Winter\Component\Form\Element;

/**
 * TextArea
 *
 * @author Lorenzo Iannone
 */
class TextArea extends Text{
    
    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->attributes['type'] = 'textarea';
    }
}
