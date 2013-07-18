<?php

namespace Winter\Foundation\Config;

use Winter\Foundation\Config\Handler\Interfaces\ConfigHandlerInterface;
use Winter\Foundation\Config\Handler\Exception\FileNotFound;
use Winter\Foundation\Config\Exception\ConfigNotReadable;
use Winter\Foundation\Config\Handler\Exception\ParseError;
use Winter\Foundation\Config\Handler\JsonConfigHandler;
use Winter\Foundation\Config\Handler\YamlConfigHandler;

/**
 * System configuration manager
 *
 * @author Lorenzo Iannone
 */
class Config {

    const ENV_VAR = 'APPLICATION_ENV';
    const ENV_PRODUCTION = 'production';
    const ENV_STAGING = 'staging';
    const ENV_DEVELOPMENT = 'development';

    const JSON_CONFIG = 'json';
    const YAML_CONFIG = 'yml';

    /**
     * Store the config handler to enocde/decode config
     * @var  Winter\Foundation\Config\Handler\Interfaces\ConfigHandlerInterface
     */
    protected $configHandler;
    
    /**
     * Store the config format 
     */
    protected static $configFormat = null;
    
    /**
     * Default constrictor, specify a config handler if you want it.
     * Otherwise a config handler will be choosen by looking at config filename
     * 
     * @param \Winter\Foundation\Config\Handler\Interfaces\ConfigHandlerInterface $configHandler
     */
    public function __construct() {
    }
    /**
     * Set a new config handler 
     * @param \Winter\Foundation\Config\Handler\Interfaces\ConfigHandlerInterface $configHandler
     */
    protected function setConfigHandler(ConfigHandlerInterface $configHandler) {
        $this->configHandler = $configHandler;
    }
    /**
     * Load a configuration from file
     * @param string $filePath
     */
    public function loadConfig($filePath) {
        
        if ($this->configHandler == null) {
            $parts = explode('.',$filePath);
            $fileExtension = strtolower($parts[count($parts)-1]);
            
            switch ($fileExtension) {
                case self::JSON_CONFIG :
                    $this->configHandler = new JsonConfigHandler();
                    break;
                case self::YAML_CONFIG :
                    $this->configHandler = new YamlConfigHandler();
                    break;
                default :
                    throw new ConfigNotReadable("File type not supported: {$filePath}");
            }
        }
        
        try {
            $config = $this->configHandler->read($filePath);
        } catch (FileNotFound $ex) {
            throw new ConfigNotReadable("Unable to read {$filePath} configuration file");
        } catch (ParseError $ex) {
            throw new ConfigNotReadable("Error while decoding {$filePath} config file");
        }
        
        return $config;
    }
    
    /**
     * Store a configuration from file
     * @param object $config
     * @param string $filePath
     */
    public function writeConfig($config, $filePath){
    }
    
    /**
     * Set the default config format
     * @param string $configFormat
     */
    public static function setConfigFormat($configFormat) {
        self::$configFormat = $configFormat;
    }
    
    /**
     * Get the default config format
     * @return string
     */
    public static function getConfigFormat() {
        if(self::$configFormat == null) {
            return self::JSON_CONFIG;
        } 
        
        return self::$configFormat;
    }
}
