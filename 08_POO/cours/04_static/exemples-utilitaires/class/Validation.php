<?php 

// Pour les appeler ds la page Validation::email, Validation::match

class Validation 
{

  /**
   * 
   * Validate a email adress format
   * 
   * @param string $data
   * @return mixed
   * 
   */
  public static function email(string $data) : mixed
  {
    $data = trim(strtolower($data));
    return filter_var($data, FILTER_VALIDATE_EMAIL);
  }

  /**
   * 
   * Match a value against another
   * 
   * @param string $data1 
   * @param string $data2
   * @return bool
   * 
   * string car un formulaire renvoi toujours des string
   */
  public static function match(string $data1, string $data2) : bool
  {
    $data1 = trim($data1);
    $data2 = trim($data2);
    return $data1 === $data2;
  }

  /**
   * 
   * Sanitize data
   * 
   * @param string $data
   * @return string
   * 
   */
  public static function sanitize(string $data) : string
  {
    return filter_var(trim($data), FILTER_SANITIZE_SPECIAL_CHARS);
  }


}