<?php
/**
 * LogEM.php
 *
 * This class implements the singleton pattern and allows you to create\alter log files based on the type passed to the log () method
 * @author Ettore Moretti 2014
 * @version 1.0
 */


/**#@+
 * Constants
 */

/**
 * DEFAULT_LOG_TYPE, the default type of log, when not declared in the log() method
 */
define("DEFAULT_LOG_TYPE","DEBUG");

/**
 * LOG_PATH, the path where log files are stored
*/
define("LOG_PATH","log/");

/**
 * LOG_PREFIX, the prefix of the final log file
*/
define("LOG_PREFIX","Log_");

/**
 * LOG_EXTENSION, the extension of the final log file
*/
define("LOG_EXTENSION",".log");

/**
 * LogEM class
 *
 * This class implements the singleton pattern and allows you to create \ alter log files based on the type passed to the log () method
 * @author Ettore Moretti 2014
 * @version 1.0
*/
class LogEM{

    /**
     * The singleton instance
     *
     * @access private static
     * @var LogEM
     */
    private static $_instanza = null;

    /**
     * A private variable,this contains all the info about the log row
     *
     * @access private
     * @var array
     */
    private $LOG;

    /**
     * Private constructor of the class
     */
    private function __construct(){
        $this->LOG=array();
    }

    /**
     * Singleton getInstance(), return instance of LogEM when not isset
     * @param null
     * @return LogEM
     */
    public static function getIstanza(){
        if(is_null(self::$_instanza))
            self::$_instanza = new LogEM();
        return self::$_instanza;
    }

    /**
     * Log method, invoked method to write a log line.
     * Accepts as input the message and the type of log ( optional, if not set is taken into account the constant DEFAULT_LOG_TYPE)
     *
     * @param obj|string|array $messaggio
     * @param string $log_type -optional
     *
     * @return integer|boolean
     */
    public function log($messaggio,$log_type=DEFAULT_LOG_TYPE){
        if(!empty($messaggio)){
            $this->LOG['date']=date("dmy");
            $this->LOG['date_d']=date("d/m/y");
            $this->LOG['date_h']=date("H:i:s");
            $this->LOG['type']=(isset($log_type) && $log_type!=null)?strtoupper($log_type):DEFAULT_LOG_TYPE;
            $this->LOG['msg']=$messaggio;
        }
        return ($this->writeLog()===false)?false: true;
    }

    /**
     * private writeLog method, method called by log (), writes in the appropriate file line log in json
     *
     * @param null
     * @return integer|boolean
     */
    private function writeLog(){
        return file_put_contents(LOG_PATH.LOG_PREFIX.$this->LOG['type'].'_'.$this->LOG['date'].LOG_EXTENSION, PHP_EOL.json_encode($this->LOG), FILE_APPEND | LOCK_EX);
    }
}
