<?php 


// Pour les appeler ds la page Form::input, Form::label

class Form
{

  public static string $defaultClass = 'form-control';

  public static function label($for, $labelName)
  {
    return '<label for="'. $for .'">'. $labelName .'</label>';
  }

  // public static function input($type, $name, $id = null, $value = "" )
  // {
  //   $id = $id ?? $name;
  //   return '<input type="'. $type .'" name="'.$name.'" id="'.$id.'" class="'. self::$defaultClass .'" value="'.$value.'" >';
  // }

  public static function input($type, $name, $value = "" )
  {
    // self:: appel un élément static de la classe (methode ou propriete)
    return '<input type="'. $type .'" name="'.$name.'" id="'.$name.'" class="'. self::$defaultClass .'" value="'.$value.'" >';
  }

  public static function select($name, $options, $selected = null)
  {

    $attributes = 'name="'.$name.'" id="'.$name.'" class="form-select '. self::$defaultClass .'"';

    // on verifie si on a un tableau associative ou indexé ( en verifiant si les cles sont comprise entre 0 et la fin du tableau)
    $isAssociative = (array_keys($options) !== range(0, count($options) - 1));

    // ATTENTION FONCTIONNE QUE QU'A PARTIR DE PHP8 : array_is_list() verifie si on a un tableau index (ici on inverse (!) le résultat pour que cela fonctionne avec notre ternaire)
    // $isAssociative = !array_is_list($options);

    foreach($options as $key => $option)
    {
      $htlmOptions[] = '<option value="'.($isAssociative ? $key : $option).'" '. ($selected === $option ? 'selected' : '') .' >'.$option.'</option>';
    }

    return '<select '.$attributes.'>'.implode($htlmOptions).'</select>';
  }

  public static function button($type, $buttonText, $class = "")
  {
    return '<button type="'.$type.'" class="'.$class.'">'.$buttonText.'</button>';
  }


}