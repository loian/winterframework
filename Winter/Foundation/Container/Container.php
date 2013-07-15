<?php

namespace Winter\Foundation\Container;

use Winter\Foundation\Container\Exception\ServiceNotDefined;
use Winter\Foundation\Config\Exception\EnvVariableNotFound;
use Winter\Foundation\Container\Exception\ReservedContextName;
use Winter\Foundation\Container\Exception\InvalidArgumentFormat;
use Winter\Foundation\Container\Exception\InvalidSetterMethod;
use Winter\Foundation\Container\Exception\SetterMethodNotFound;
use Winter\Foundation\Config\Config;
use Winter\Foundation\Container\Validator\ConfigValidator;

/**
 * Service Container
 *
 * @author Lorenzo Iannone
 */
final class Container {

    const DEFAULT_CONTEXT = 'default';
    const NEWINSTANCE_CONTEXT = 'newinstance';

    /**
     * Singleton instance of Container
     * @var Winter\Foundation\Container\Container 
     */
    private static $instance;

    /**
     * List of registered services
     * @var array
     */
    protected $services;

    /**
     * Array representing the container config
     * @var array
     */
    protected $containerConfig;

    /**
     * Default private constructor
     */
    private function __construct() {
        $this->services = array();
        $this->loadContainerConfig();
        foreach ($this->containerConfig->services as $service) {
            if (!isset($service->calls)) {
                $service->calls = null;
            }
            $this->register($service->class, $service->name, $service->context, $service->arguments, $service->calls);
        }
    }

    /**
     * Return the singleton instance of Container
     * 
     * @return Winter\Foundation\Container\Container
     */
    public static function getInstance() {
        /* check if an instance already exists */
        if (self::$instance === null) {
            self::$instance = new Container();
        }

        /* returns the instance */
        return self::$instance;
    }

    /**
     * load the container confing from json
     * 
     * @throws EnvVariableNotFound
     * @throws EnvConfigNotFound
     */
    protected function loadContainerConfig() {
        $env = getenv(Config::ENV_VAR);

        /* check if env is defined */
        if (empty($env)) {
            throw new EnvVariableNotFound();
        }

        /* check if config file exists */
        $path = $_SERVER["DOCUMENT_ROOT"] . 'Winter/Init/Config/' . ucfirst($env) . '/container.json';

        if (!file_exists($path)) {
            throw new EnvConfigNotFound();
        }

        $this->containerConfig = json_decode(file_get_contents($path));
    }

    /**
     * register a service in the container
     * 
     * @param type $serviceClassName
     * @param type $serviceGlobalName
     */
    public function register($serviceClassName, $serviceGlobalName, $serviceContexts, $arguments, $calls) {


        if (!isset($this->services[self::DEFAULT_CONTEXT]) || !is_array($this->services[self::DEFAULT_CONTEXT])) {
            $this->services[self::DEFAULT_CONTEXT] = array();
        }
        //register the service in the default context
        $this->services[self::DEFAULT_CONTEXT][$serviceGlobalName] = $this->newInstance($serviceClassName, $arguments, $calls);

        //register the service in all declared contexts
        if (is_array($serviceContexts) && sizeof($serviceContexts) > 0) {
            foreach ($serviceContexts as $context) {

                //check in the context is available (not used by system)
                if ($context == self::DEFAULT_CONTEXT || $context == self::NEWINSTANCE_CONTEXT) {
                    throw new ReservedContextName("Context name {$context} is used by system and not available for service {$serviceGlobalName}");
                }

                if (!isset($this->services[$context]) || !is_array($this->services[$context])) {
                    $this->services[$context] = array();
                }

                $this->services[$context][$serviceGlobalName] = $this->newInstance($serviceClassName, $arguments, $calls);
            }
        }
    }

    /**
     * Build an array of arguments from json argument definition
     * 
     * @param array $arguments
     * @return array
     * @throws InvalidArgumentFormat
     */
    private function buildArgumentInstances($arguments) {

        $validator = new ConfigValidator();
        $argumentInstances = array();

        foreach ($arguments as $arg) {

            //validate tha argument
            if (!$validator->validateArgument($arg)) {
                throw new InvalidArgumentFormat("Invalid dependency injection argument {$arg}");
            }

            //split arguments in servicename ad context            
            $explodedArgs = explode("@", $arg);
            $serviceArgName = (!empty($explodedArgs[0])) ? $explodedArgs[0] : null;
            $serviceArgContext = (!empty($serviceArgContext[1])) ? $explodedArgs[1] : 'default';
            $argumentInstances[] = $this->getService($serviceArgName, $serviceArgContext);
        }
        return $argumentInstances;
    }

    /**
     * Create a new class instance injecting dependencies
     * 
     * @param string $className class of the new instance
     * @param array $arguments contains string in format servicename@context
     */
    private function newInstance($className, $arguments, $calls) {

        $argumentInstances = $this->buildArgumentInstances($arguments);

        //create and return a new instance of a service
        $reflectedClass = new \ReflectionClass($className);
        $injectable = $reflectedClass->newInstanceArgs($argumentInstances);

        //if true, we have also setter injection
        if ($calls != null) {

            //validate calls structure
            foreach ($calls as $call) {

                //check if setter method is provided
                if (empty($call->method)) {
                    throw new SetterMethodNotFound();
                }

                //arguments taken from call definition
                $callArguments = empty($call->arguments) ? array() : $call->arguments;

                //arguments for the setter method
                $setterArguments = $this->buildArgumentInstances($callArguments);

                //check if setter method exists
                if (!method_exists($injectable, $call->method)) {
                    throw new InvalidSetterMethod();
                }

                //call the setter
                call_user_func_array(array($injectable, $call->method), $setterArguments);
            }
        }

        return $injectable;
    }

    /**
     * Return a service instance
     * 
     * @param string $serviceName
     * @param string $newIstance
     * @return \Winter\Foundation\Container\className
     * @throws \Winter\Foundation\Container\Exception\ServiceNotDefined
     */
    public function getService($serviceName, $context = 'default') {

        if (empty($this->services[$context]) || !key_exists($serviceName, $this->services[$context])) {
            throw new ServiceNotDefined();
        }

        if ($context == self::NEWINSTANCE_CONTEXT) {
            //id context is 'newinstance' get the name of the class from the default
            //context but return a new instance
            $className = get_class($this->services[self::DEFAULT_CONTEXT][$serviceName]);

            return $this->newInstance($className, $this->getArgumentsFromConfig($serviceName));
        } else {
            return $this->services[$context][$serviceName];
        }
    }

    /**
     * Extract constructor arguments of a given service from container configuration
     * 
     * @param string $serviceName
     * @return array
     */
    public function getArgumentsFromConfig($serviceName) {
        foreach ($this->containerConfig->services as $serviceConf) {
            if ($serviceConf->name == $serviceName) {
                return $serviceConf->arguments;
            }
        }
    }
}
