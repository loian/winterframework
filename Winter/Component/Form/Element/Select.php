<?php

namespace Winter\Component\Form\Element;

use Winter\Component\Form\Element\Element;
use Winter\Component\Form\Element\Interfaces\ValidableInterface;
use Winter\Component\Form\Validator\Interfaces\ValidatorInterface;
use Winter\Component\Form\Element\SelectOption;
use Winter\Foundation\Iterator\Interfaces\IteratorInterface;

/**
 * Select
 *
 * @author Lorenzo Iannone
 */
class Select extends Element implements ValidableInterface, IteratorInterface {

    /**
     * Options of select
     * @var \Winter\Component\Form\Element\SelectOption[]
     */
    protected $options;

    public function __construct() {
        parent::__construct();
        $this->attributes['type'] = 'select';
    }

    /**
     * Add a validator 
     * @param \Winter\Component\Form\Validator\Interfaces\ValidatorInterface $validator
     * @return \Winter\Component\Form\Element\Select
     */
    public function addValidator(ValidatorInterface $validator) {
        $this->validators[] = $validator;
        return $this;
    }

    /**
     * set all validators
     * @param \Winter\Component\Form\Validator\Interfaces\ValidatorInterface[] $validator
     * @return \Winter\Component\Form\Element\Select
     */
    public function setValidators($validators) {
        $this->validators = $validators;
        return $this;
    }

    /**
     * Set all options
     * @param array $options
     * @return \Winter\Component\Form\Element\Select
     */
    public function setOptions($options) {
        $this->options = $options;
        return $this;
    }

    /**
     * Set an option
     * @param string $value
     * @param string $text
     * @return \Winter\Component\Form\Element\Select
     */
    public function setOption(SelectOption $option) {
        $this->options[] = $option;
        return $this;
    }

    public function iterate() {
        foreach ($this->options as $option) {
            //yield $option;
        }
    }

}
