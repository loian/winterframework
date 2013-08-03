<?php

namespace Winter\Component\Form\Element;

use Winter\Component\Form\Element\Element;
use Winter\Component\Form\Element\Interfaces\ValidableInterface;
use Winter\Component\Form\Validator\Interfaces\ValidatorInterface;
use Winter\Component\Form\Element\SelectOption;
use Winter\Foundation\Iterator\Interfaces\IteratorInterface;
use Winter\Component\Form\Renderer\Interfaces\RenderableInterface;
use Winter\Component\Form\Renderer\Interfaces\RendererInterface;
use Winter\Component\Form\Renderer\SelectRenderer;

/**
 * Select
 *
 * @author Lorenzo Iannone
 */
class Select extends Element implements RenderableInterface, ValidableInterface, IteratorInterface {

    /**
     * Options of select
     * @var \Winter\Component\Form\Element\SelectOption[]
     */
    protected $options;

    public function __construct() {
        parent::__construct();
        $this->setRenderer(new SelectRenderer());
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
     * Get array of selectOptions
     * @return \Winter\Component\Form\Element\SelectOption[]
     */
    public function getOptions() {
        return $this->options;
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

    public function getValue() {
        foreach ($this->options as $option) {
            if ($option->isSelected()) {
                return $option->getValue();
            }
        }

        if (count($this->options) > 0) {
            return $this->options->getValue();
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
