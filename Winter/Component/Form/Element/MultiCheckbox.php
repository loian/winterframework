<?php

namespace Winter\Component\Form\Element;

use Winter\Component\Form\Element\Element;
use Winter\Component\Form\Element\Interfaces\ValidableInterface;
use Winter\Component\Form\Validator\Interfaces\ValidatorInterface;
use Winter\Foundation\Iterator\Interfaces\IteratorInterface;

/**
 * MultiCheckbox
 *
 * @author Lorenzo Iannone
 */
class MultiCheckbox extends Element implements ValidableInterface,  IteratorInterface {

    protected $attributes;
    
    /**
     * @var \Winter\Component\Form\Element\Checkbox
     */
    protected $checkboxes;
    
    public function __construct() {
        parent::__construct();
        $this->attributes['type'] = 'checkbox';      
        $this->checkboxes = array();
    }
    
    
    /**
     * Add a validator 
     * @param \Winter\Component\Form\Validator\Interfaces\ValidatorInterface $validator
     * @return Winter\Component\Form\Element\Checkbox
     */
    public function addValidator(ValidatorInterface $validator) {
        $this->validators[] = $validator;
        return $this;
    }

    /**
     * set all validators
     * @param \Winter\Component\Form\Validator\Interfaces\ValidatorInterface[] $validator
     * @return Winter\Component\Form\Element\Checkbox
     */
    public function setValidators($validators) {
        $this->validators = $validators;
        return $this;
    }

    /**
     * Set the checked value
     * @param string $value
     * @return Winter\Component\Form\Element\MultiCheckbox
     */
    public function setCheckedValue($value) {
        $this->checkedValue = $value;
        foreach($this->checkboxes as $check) {
            $check->setCheckedValue($this->getCheckedValue());
        }
        return $this;
    }

    /**
     * Set the unchecked value
     * @param string $value
     * @return Winter\Component\Form\Element\MultiCheckbox
     */
    public function setUncheckedValue($value) {
        $this->uncheckedValue = $value;
        foreach($this->checkboxes as $check) {
            $check->setUncheckedValue($this->getUncheckedValue());
        }        
        return $this;
    }

    /**
     * Get the checked value
     * @return string 
     */
    public function getCheckedValue() {
        return $this->checkedValue;
    }

    /**
     * Get the unchecked value
     * @return string 
     */
    public function getUncheckedValue() {
        return $this->uncheckedValue;
    }
    
    public function addCheck(Checkbox $check) {

        $check->setCheckedValue($this->getCheckedValue());
        $check->setUncheckedValue($this->getUncheckedValue());
        
        $this->checkboxes[] = $check;
                
    }

    public function iterate() {
        foreach($this->checkboxes as $check) {
            //yield $check;
        }
    }
    
    public function getChecked() {
        $result = array();
        foreach($this->checkboxes as $check) {
            $result[] = $check->isChecked();
        }
        return $result;
    }
    
}

