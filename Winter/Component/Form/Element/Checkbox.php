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

    /**
     * @var \Winter\Component\Form\Validator\Interfaces\ValidatorInterface[]
     */
    protected $validators;

    /**
     * The value of checked checkbox
     * @var string
     */
    protected $checkedValue;

    /**
     * The value of unchecked checkbox
     * @var string
     */
    protected $uncheckedValue;



    public function __construct() {
        parent::__construct();

        //set the type
        $this->attributes['type'] = 'checkbox';

        //set the default values
        $this->checkedValue = "1";
        $this->checkedValue = "0";
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
     */
    public function setCheckedValue($value) {
        $this->checkedValue = $value;
    }

    /**
     * Set the unchecked value
     * @param string $value
     */
    public function setUncheckedValue($value) {
        $this->uncheckedValue = $value;
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

    /**
     * Check the checkbox
     */
    public function check() {
        $this->attributes['checked'] = $this->checkedValue;
    }

    /**
     * Uncheck the checkbox
     */
    public function uncheck() {
        $this->attributes['checked'] = $this->uncheckedValue;
    }

    /**
     * Check if checked :)
     * 
     * @return boolean
     */
    public function isChecked() {
        if (!empty($this->attributes['checked']) && $this->attributes['checked'] == $this->checkedValue) {
            return true;
        }
        return false;
    }

}
