<?php
namespace Winter\Foundation\Container\Validator;

/**
 * Validate injection arguments
 *
 * @author Lorenzo Iannone
 */
class ConfigValidator {
    
    const ARG_VALIDATION_REGEX = '~^[a-zA-Z]+(@[a-zA-Z]+)?$~';
    
    /**
     * Generic validation method, use a regexp to validate a string
     * 
     * @param string $argument
     * @param string $regex
     * @return boolean
     */
    protected function validate($val, $regex) {
        if (!preg_match($regex, $val)) {
            return false;
        }
        return true;
    }
    
    /**
     * Validate a dependency injection argument
     * @param string $argument
     * @return boolean
     */
    public function validateArgument($argument) {
        return $this->validate($argument, self::ARG_VALIDATION_REGEX);
    }
}