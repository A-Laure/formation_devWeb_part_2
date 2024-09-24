<?php 

// Pour les appeler ds la page Session::start, Session::set

class Session
{


  /**
   * 
   * Start the session
   * 
   * @return void
   */
  public static function start() : void
  {
    if(session_status() == PHP_SESSION_NONE)
    {
      session_start();
    }
  }

  
  /**
   * 
   * Set a session key/value 
   * 
   * @param string $key
   * @param mixed $value
   * @return void
   */
  public static function set(string $key, mixed $value) : void
  {
    $_SESSION[$key] = $value;
  }



  /**
   * 
   * Get a session key/value 
   * 
   * @param string $key
   * @param mixed $default
   * @return mixed
   */
  public static function get(string $key, mixed $default = null) : mixed
  {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
  }
  
  /**
   * 
   * Check if session key exist 
   * 
   * @param string $key
   * @return bool
   */
  public static function has(string $key) : bool
  {
    return isset($_SESSION[$key]);
  }


  /**
   * 
   * clear session by key
   * 
   * @param string $key
   * @return void
   */
  public static function clear(string $key) : void
  {
    if(isset($_SESSION[$key]))
    {
      unset($_SESSION[$key]);
    }

    // if(self::has($key))
    // {
    //   unset($_SESSION[$key]);
    // }
    
  }

  /**
   * 
   * clear all session data
   * 
   * @return void
   */
  public static function clearAll() : void
  {
    session_unset();
    session_destroy();
  }

  /**
   * 
   * Set a flash message
   * @param string $key
   * @param string $message
   * @return void
   */
  public static function setFlashMessage(string $key,string $message) : void
  {
    self::set('flash_'.$key, $message);
  }

  /**
   * 
   * Get a flash message and unset
   * @param string $key
   * @param mixed $default
   * @return string
   */
  public static function getFlashMessage(string $key, mixed $default = null) : string
  {
    $message = self::get('flash_'.$key, $default);
    self::clear('flash_'.$key);
    return $message;
  }


}
