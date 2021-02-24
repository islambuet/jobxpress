<?php
    namespace App\HelperClasses;
    use App\Models\Configuration;
    class ConfigurationHelper
    {
        public static $config = array();
        public static function loadConfig()
        {
            $results = Configuration::get();
            foreach($results as $result){
                self::$config[$result->key]=$result->value;
            }
        }
        public static function getJobExpireDays()
        {
            if(!self::$config)
            {
                self::loadConfig();                
            }
            return isset(self::$config['JOB_EXPIRE_DAYS'])?self::$config['JOB_EXPIRE_DAYS']:10;
        }
        public static function getJobMaxReActivationCount()
        {
            if(!self::$config)
            {
                self::loadConfig();                
            }
            return isset(self::$config['JOB_MAX_REACTIVATION'])?self::$config['JOB_MAX_REACTIVATION']:1;
        }
    }
    