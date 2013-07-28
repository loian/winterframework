<?php

namespace Winter\Component\Form\Element;

use Winter\Component\Form\Element\Element;
use Winter\Component\Form\Element\Interfaces\ValidableInterface;
use Winter\Component\Form\Validator\Interfaces\ValidatorInterface;
/**
 * Checkbox
 *
 * @author Lorenzo Iannone
 */
class Checkbox extends Element implements ValidableInterface {
  
    protected $validators;
    
    public function __construct() {
        parent::__construct();
        $this->attributes['type'] = 'checkbox';
    }

    public function addValidator(ValidatorInterface $validator) {
        $this->validators[] = $validator;
    }
    
    public function setValidators ($validators) {
        $this->validators = $validators;
    }
    
}
