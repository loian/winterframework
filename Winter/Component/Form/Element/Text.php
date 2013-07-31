<?php

namespace Winter\Component\Form\Element;

use Winter\Component\Form\Element\Element;
use Winter\Component\Form\Element\Interfaces\ValidableInterface;
use Winter\Component\Form\Validator\Interfaces\ValidatorInterface;
use Winter\Component\Form\Renderer\Interfaces\RenderableInterface;
use Winter\Component\Form\Renderer\Interfaces\RendererInterface;
use Winter\Component\Form\Renderer\TextRenderer;

/**
 * InputText
 *
 * @author Lorenzo Iannone
 */
class Text extends Element implements ValidableInterface, RenderableInterface {

    /**
     * @var \Winter\Component\Form\Validator\Interfaces\ValidatorInterface[]
     */
    protected $validators;
    
    /**
     * The element renderer
     * @var  Winter\Component\Form\Renderer\Interfaces\RendererInterface
     */
    protected $renderer;

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        $this->validators = array();
        //set the default renderer
        $this->renderer = new TextRenderer();
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
