<?php

namespace Winter\Component\Form\Interfaces;

/**
 * FormInterface
 * 
 * @author Lorenzo Iannone
 */
interface FormInterface {
    
    /**
     * Set the parent of the current form
     * @param \winter\Componente\Form\Interfaces\FormInterface $parent
     */
    public function setParent(FormInterface $parentForm);
    
    /**
     * Get the parent form of the current one
     * @return FormInterface;
     */
    public function getParent();
    
}
