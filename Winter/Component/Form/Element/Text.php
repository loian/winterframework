<?php

namespace Winter\Component\Form\Element;


use Winter\Component\Form\Element\Element;
use Winter\Component\Form\Element\Interfaces\ValidableInterface;
use Winter\Component\Form\Validator\Interfaces\ValidatorInterface;
/**
 * InputText
 *
 * @author Lorenzo Iannone
 */
class Text extends Element implements ValidableInterface {
    
    /**
     * @var \Winter\Component\Form\Validator\Interfaces\ValidatorInterface[]
     */
    protected $validators;
    
    public function __construct() {
        parent::__construct();
        $this->validators = array();        
        $this->attributes['type'] = 'text';
    }
    
    
    /**
     * Add a validator 
     * @param \Winter\Component\Form\Validator\Interfaces\ValidatorInterface $validator
     * @return \Winter\Component\Form\Element\Text
     */
    public function addValidator(ValidatorInterface $validator) {
        $this->validators[] = $validator;
        return $this;
    }

    /**
     * set all validators
     * @param \Winter\Component\Form\Validator\Interfaces\ValidatorInterface[] $validator
     * @return \Winter\Component\Form\Element\Text
     */
    public function setValidators($validators) {
        $this->validators = $validators;
        return $this;
    }
    
    /**
     * Shortcut for setAttribute('value',..);
     * @param string $value
     * @return \Winter\Component\Form\Element\Text
     */
    public function setValue($value) {
        $this->attributes['value'] = $value;
        return $this;
    }

    /**
     * Shortcut for getAttribute('value');
     * @param string $value
     */    
    public function getValue() {
        return $this->getAttribute('value');
    }
}
