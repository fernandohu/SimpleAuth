<?php
namespace SimpleAuth;

use \SessionHandlerInterface;

class Auth
{
    /**
     * @var Auth
     */
    private static $instance;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    /**
     * @var string
     */
    protected static $sessionKey = 'eindhoven.auth';

    /**
     * @var string
     */
    protected static $sessionName = 'SESSID';

    static function init()
    {
        ini_set('session.serialize_handler', 'php_serialize');
    }

    /**
     * @param string $sessionKey
     */
    public static function setNamespace($sessionKey)
    {
        self::$sessionKey = $sessionKey . '.auth';
    }

    /**
     * @return string
     */
    public static function getNamespace()
    {
        return self::$sessionKey;
    }

    /**
     * @param $sessionName
     */
    public static function setSessionName($sessionName)
    {
        self::$sessionName = $sessionName;
    }

    /**
     * @return string
     */
    public static function getSessionName()
    {
        self::$sessionName = session_name();
        return self::$sessionName;
    }

    /**
     * Use this method if you want to store data in other place than default PHP files.
     * For example, you can use a DB or Memcache adapter. You if don't call this method,
     * the default PHP file handler will be used.
     *
     * @param SessionHandlerInterface $adapter
     * @param bool $registerShutdown
     */
    public static function setCustomSaveHandler(SessionHandlerInterface $adapter, $registerShutdown = true)
    {
        session_set_save_handler($adapter, $registerShutdown);
    }

    /**
     * @return Auth
     * @throws SessionNamespaceNotInitialized
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            session_name(self::$sessionName);
            session_start();

            if (self::$sessionKey == '') {
                throw new SessionNamespaceNotInitialized();
            }

            self::$instance = new self;

            if (!isset($_SESSION[self::$sessionKey]))
            {
                $_SESSION[self::$sessionKey] = null;
            }
        }

        return self::$instance;
    }

    /**
     * @return boolean
     */
    public function isLogged()
    {
        return isset($_SESSION[self::$sessionKey]);
    }

    /**
     * @param mixed $sessionData
     */
    public function login($sessionData)
    {
        $this->setData($sessionData);
    }

    public function logOut()
    {
        $_SESSION[self::$sessionKey] = null;
    }

    public function getData()
    {
        return $_SESSION[self::$sessionKey];
    }

    /**
     * @param mixed $sessionData
     */
    public function setData($sessionData)
    {
        $_SESSION[self::$sessionKey] = $sessionData;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setValue($key, $value)
    {
        if (!is_array($_SESSION[self::$sessionKey])) {
            $_SESSION[self::$sessionKey] = array();
        }

        $_SESSION[self::$sessionKey][$key] = $value;
    }

    /**
     * @param $key
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getValue($key, $defaultValue = null)
    {
        if (isset($_SESSION[self::$sessionKey][$key]))
        {
            return $_SESSION[self::$sessionKey][$key];
        }

        return $defaultValue;
    }

    public function discardDataChanges()
    {
        session_reset();
    }

    public function changeSessionId($deleteData = false)
    {
        session_regenerate_id($deleteData);
    }

    public function getSessionId()
    {
        return session_id();
    }
}