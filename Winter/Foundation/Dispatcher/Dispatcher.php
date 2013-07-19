<?php

namespace Winter\Foundation\Dispatcher;

use Winter\Foundation\Event\Interfaces\EventInterface;
use Winter\Foundation\Listener\Interfaces\ListenerInterface;
use Winter\Foundation\Config\Exception\EnvVariableNotFound;
use Winter\Foundation\Dispatcher\Exception\ConditionMethodInvalid;
use Winter\Foundation\Dispatcher\Exception\ConditionNotFound;
use Winter\Foundation\Dispatcher\Exception\ExecuteMethodNotFoundInListener;
use Winter\Foundation\Config\Config;
use Winter\Foundation\Config\Handler\JsonConfigHandler;
use Winter\Foundation\Config\Handler\YamlConfigHandler;


/**
 * System event dispatcher
 *
 * @author Lorenzo Iannone
 */
final class Dispatcher {

    const CONDITION_MATCH = 'match';
    const CONDITION_EXECUTE = 'execute';

    /**
     * Singleton instance of Dispatcher
     * @var Distpatcher
     */
    private static $instance = null;

    /**
     * System configuration object
     * @var StdClass
     */
    private $componentConfig;
    
    
    /**
     * All registeren listeners
     * @var array
     */
    private $listeners;

    /**
     * Private constructor of the Dispacher;
     */
    private function __construct() {
        $this->loadDispatcherConfig();
        if(!empty($this->componentConfig->listeners)) {
            foreach ($this->componentConfig->listeners as $listener) {
                $this->register($listener->class, $listener->event);
            }
        }
    }

    /**
     * Load json configuration file
     */
    protected function loadDispatcherConfig() {
        $env = getenv(Config::ENV_VAR);

        /* check if env is defined */
        if (empty($env)) {
            throw new EnvVariableNotFound();
        }

        /* check if config file exists */
        $path = $_SERVER["DOCUMENT_ROOT"] . 'Init/Config/' . ucfirst($env) . '/dispatcher.' . Config::getConfigFormat();

        $configManager = new Config();
        $this->componentConfig = $configManager->loadConfig($path);
    }

    /**
     * Returns the singleton instance of Dispatcher
     * @return \Winter\Foundation\Dispatcher\Dispatcher
     */
    public static function getInstance() {

        /* check if an instance already exists */
        if (self::$instance === null) {
            self::$instance = new Dispatcher();
        }

        /* returns the instance */
        return self::$instance;
    }

    /**
     * Register a listener in the Dispatcher
     * 
     * @param \Winter\Foundation\Dispatcher\ListenerInterface $listener
     * @param string $eventClassName
     */
    public function register($listenerClassName, $eventClassName) {

        /* initialize the record related to to $eventClassName 
         * if it's not an array */
        if (!isset($this->listeners[$eventClassName]) || !is_array($this->listeners[$eventClassName])) {
            $this->listeners[$eventClassName] = array();
        }

        $this->listeners[$eventClassName][] = $listenerClassName;
    }

    public function unregister($listenerClassName) {
        foreach ($this->listeners[$eventClassName] as $regEvent => $regListenersList) {
            foreach ($regListenersList as $listenerKey => $regListener) {
                if ($regListener == $listenerClassName) {
                    unset($this->listeners[$regEvent][$listenerKey]);
                }
            }
        }
    }

    /**
     *  Notify an event  waking up any interested listener
     * @param \Winter\Foundation\Event\Interfaces\EventInterface $event
     */
    public function notify(EventInterface $event) {
        $eventClassName = get_class($event);
        if (!empty($this->listeners[$eventClassName])) {
            foreach ($this->listeners[$eventClassName] as $listener) {
                $executor = new $listener();
                if ($this->checkCondition($executor, $event)) {
                    $executor->execute($event);
                }
            }
        }
    }

    /**
     * Check if a condition to execute the listener is reached
     * 
     * @param \Winter\Foundation\Event\Interfaces\EventInterface $event
     * @throws ConditionMethodNotFound
     * @throws ConditionNotFound
     * @return boolean
     */
    protected function checkCondition(ListenerInterface $listener, EventInterface $event) {
        $descriptor = $listener->getDescriptor();
        $classDescription = $descriptor[0];

        //check if a condition tag exists
        if (!empty($classDescription->tags['condition'][0])) {
            //if it exists, must exists also the @conditionmethod
            if (!empty($classDescription->tags['conditionmethod'][0])) {

                switch ($classDescription->tags['conditionmethod'][0]) {
                    case self::CONDITION_MATCH:
                        //compare the @condition annotation to the event identifier
                        if (preg_match('~' . $classDescription->tags['condition'][0] . '~', $event->getIdentifier())) {
                            return true;
                        }
                        break;

                    case self::CONDITION_EXECUTE:
                        $methodName = $classDescription->tags['condition'][0];

                        //if the listener hasn't the condition execute method
                        //throws an exception
                        if (!method_exists($listener, $methodName)) {
                            throw new ExecuteMethodNotFoundInListener();
                        }

                        //invoke the method declared as execution condition checker
                        //to check if execute has to be called
                        if ($listener->{$methodName}($event)) {
                            $listener->execute($event);
                        }
                        break;

                    default:
                        throw new ConditionMethodInvalid();
                        break;
                }
            } else {
                //@conditionmethod not found
                throw new ConditionMethodNotFound();
            }
        } else {
            //if exists only @conditionmethod
            if (!empty($classDescription->tags['conditionmethod'])) {
                throw new ConditionNotFound();
            }

            //here doesn't exist condition and conditionmethod
            //so we have to execute the listener
            $listener->execute($event);
        }
    }

}