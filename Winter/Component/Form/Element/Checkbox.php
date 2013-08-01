<?php

namespace Winter\Component\Form\Element;

use Winter\Component\Form\Element\Element;
use Winter\Component\Form\Element\Interfaces\ValidableInterface;
use Winter\Component\Form\Validator\Interfaces\ValidatorInterface;
use Winter\Component\Form\Renderer\Interfaces\RenderableInterface;
use Winter\Component\Form\Renderer\Interfaces\RendererInterface;
use Winter\Component\Form\Renderer\CheckboxRenderer;
/**
 * Checkbox
 *
 * @author Lorenzo Iannone
 */
class Checkbox extends Element implements ValidableInterface, RenderableInterface {

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

    /**
     * The element renderer
     * @var  Winter\Component\Form\Renderer\Interfaces\RendererInterface
     */
    protected $renderer;

    public function __construct() {
        parent::__construct();

        //set the default values
        $this->checkedValue = "1";
        $this->checkedValue = "0";
        
        $this->setRenderer(new CheckboxRenderer);
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
     * @return Winter\Component\Form\Element\Checkbox
     */
    public function setCheckedValue($value) {
        $this->checkedValue = $value;
        return $this;        
    }

    /**
     * Set the unchecked value
     * @param string $value
     * @return Winter\Component\Form\Element\Checkbox
     */
    public function setUncheckedValue($value) {
        $this->uncheckedValue = $value;
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

    public function getValue() {
        if($this->isChecked()) {
            return $this->getCheckedValue();
        }
        
        return null;
        
    }

    /**
     * Return the renderer
     * @return Winter\Component\Form\Renderer\Interfaces\RendererInterface
     */
    public function getRender() {
        return $this->rendered;
    }

    /**
     * Render the element
     * @return string
     */
    public function render() {
        return $this->renderer->render($this);
    }

    /**
     * Set the renderer
     * @param \Winter\Component\Form\Renderer\Interfaces\RendererInterface $renderer
     * @return \Winter\Component\Form\Element\Text
     */
    public function setRenderer(RendererInterface $renderer) {
        $this->renderer = $renderer;
        return $this;
    }

}
