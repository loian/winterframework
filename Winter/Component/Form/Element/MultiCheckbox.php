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
    
    public function addCheck(Checkbox $check) {
        $check->setName($this->attributes['name'].'[]');
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
    
    public function getValue() {
        $val = array();
        foreach($this->checkboxes as $check) {
            if($check->isChecked()) {
                $val[] = $check->getValue();
            }
        }
        return $val;
    }
    
    public function getChecboxes() {
        return $this->checkboxes;
    }

    /**
     * Set one attribute
     * 
     * @param string $key
     * @param mixed $value
     * @return \Winter\Component\Form\Element\Element
     * @throws TypeOverride
     */
    public function setAttribute($key, $value) {
         if(strtolower($key) == 'type') {
             throw new TypeOverride();
         }

         if(strtolower($key) == 'name') {
             foreach($this->checkboxes as $check) {
                 $check->setAttribute($key, $value.'[]');
             }
         }        
         
        $this->attributes[$key] = $value;        
        return $this;
    }    
    
    /**
     * Set one or more attributes
     * @param array $attributes
     * @return \Winter\Component\Form\Element\Element
     * @throws TypeOverride
     */
    public function setAttributes($attributes) {
        if($this->chechTypeOverride()) {
            throw new TypeOverride();
        }
        
        $this->attributes = $attributes;
        
        foreach($this->checkboxes as $check) {
            $check->setAttribute('name', $this->attributes['name'].'[]');
        }
        
        return $this;
    }    
}

