<?php

namespace Winter\Component\Form\Element;

use Winter\Component\Form\Element\Element;
use Winter\Component\Form\Element\Interfaces\ValidableInterface;

/**
 * Hidden
 *
 * @author Lorenzo Iannone
 */
class Hidden extends Element implements ValidableInterface {

    protected $validators;

    public function __construct() {
        parent::__construct();
        $this->validators = array();
        $this->attributes['type'] = 'hidden';
    }
    
    /**
     * Add a validator 
     * @param \Winter\Component\Form\Validator\Interfaces\ValidatorInterface $validator
     * @return \Winter\Component\Form\Element\Hidden
     */
    public function addValidator(ValidatorInterface $validator) {
        $this->validators[] = $validator;
        return $this;
    }

    /**
     * set all validators
     * @param \Winter\Component\Form\Validator\Interfaces\ValidatorInterface[] $validator
     * @return \Winter\Component\Form\Element\Hidden
     */
    public function setValidators($validators) {
        $this->validators = $validators;
        return $this;
    }
}
