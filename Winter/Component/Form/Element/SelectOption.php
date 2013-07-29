<?php

namespace Winter\Component\Form\Element;

/**
 * SelectOption
 *
 * @author Lorenzo Iannone
 */
class SelectOption {

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var booelan
     */
    protected $isSelected;

    /**
     * @var booelan
     */
    protected $isDisabled;

    /**
     * @var string
     */
    protected $label;

    /**
     * Default constructor
     * 
     * @param string $value
     * @param string $text
     * @param boolean $selected optional
     * @param boolean $disabled optional
     * @param string $label optional
     */
    public function __construct($value, $text, $selected = false, $disabled = false, $label = null) {
        $this->value = $value;
        $this->text = $text;
        $this->isSelected = $selected;
        $this->isDisabled = $disabled;
        $this->label = $label;
    }

    /**
     * Get the value
     * 
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Get the text
     * 
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Is selected
     * 
     * @return boolean
     */
    public function isSelected() {
        return $this->isSelected;
    }

    /**
     * Is disabled
     * 
     * @return boolean
     */
    public function isDisabled() {
        return $this->isDisabled;
    }

    /**
     * Get the label
     * 
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

}
