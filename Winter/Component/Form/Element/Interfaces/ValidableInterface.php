<?php

namespace Winter\Component\Form\Element\Interfaces;

use Winter\Component\Form\Validator\Interfaces\ValidatorInterface;

/**
 * ValidableInterface
 * 
 * @author Lorenzo Iannone
 */
interface ValidableInterface {

    /**
     * Set all validators
     * @param array $validator
     */
    public function setValidators($validators);

    /**
     * Add a validator
     * @param \Winter\Component\Form\Validator\Interfaces\ValidatorInterface $validator
     */
    public function addValidator(ValidatorInterface $validator);
}

?>
