<?php

namespace Winter\Component\Form;

use Winter\Foundation\Iterator\Interfaces\IteratorInterface;
use Component\Form\Interfaces\FormInterface;

/**
 * Form class.
 * Data of the form a represente in 2 different formats:
 * 1)The processableData, like server process (a date like 20130817);
 * 2)postableData, like server receives (a date in human readable format like 17 Aug 2013)
 * 3)userData like user sees (ie. label translations)
 *
 * @author Lorenzo Iannone
 */
class Form implements FormInterface, IteratorInterface {

    /**
     * Processable data, as the server need to been processed
     * @var type 
     */
    protected $processableData;

    /**
     * Postable data, as the form need to post them
     * @var type 
     */
    protected $postableData;

    /**
     * User data, as the user sees
     * @var type 
     */
    protected $userData;

    /**
     * The form containg this one
     * @var type 
     */
    protected $parentForm;

    /**
     * A list of all children
     * @var array
     */
    protected $children;

    /**
     * Default form constructor
     */
    public function construct() {
        $this->processableData = array();
        $this->postableData = array();
        $this->userData = array();
        $this->children = array();
    }

    /**
     * Generate iterator over the child
     * @yeld FormInterface
     */
    public function iterate() {
        foreach($this->children as $c) {
            //yield $c;
        }
    }
    
    
    /**
     * Set the parent of the current form
     * @param \winter\Componente\Form\Interfaces\FormInterface $parent
     */
    public function setParent(FormInterface $parentForm) {
        $this->parentForm = $parentForm;
    }

    /**
     * Get the parent form of the current one
     * @return FormInterface;
     */
    public function getParent() {
        return $this->parentForm;
    }

    public function addChild(FormInterface $childForm) {
        $this->children[] = $childForm;
    }

}
