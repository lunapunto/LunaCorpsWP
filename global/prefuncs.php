<?php
/*
* Archivo de prefunciones
* Este archivo se utiliza tanto en admin como en main y sirve para obtener las funciones claves.
*
* Notar que todos los archivos que se tengan que incluir con llamados con require al ser vitales.
*/



$dir = get_stylesheet_directory_uri();
define('dir', $dir);
define('asset', dir.'/assets');
define('js', asset.'/js');
define('css', asset.'/css');
define('img', asset.'/img');
define('meta', asset.'/meta');





/* Helpers */

/*
* () i
* Busca un elemento en un array
* Previene un error warning si el elemento no existe
*
* @params $element (mixed) [obligatorio] - Elemento
* @params $array (array) [default $_GET] - Haystack
*
* (mixed) Si no existe devuelve (bool) false, si sí existe devuelve el elemento
*/
function i($element, $array = array()){
  if(!count($array)){
    $array = $_GET;
  }
  if(isset($array[$element])){
    return $array[$element];
  }else{
    return false;
  }
}

/*
* () v
* Busca un elemento en un array
* Previene un error warning si el elemento no existe. A diferencia de i() devuelve siempre un string.
*
* %parent () i
*
* @params $element (mixed) [obligatorio] - Elemento
* @params $array (array) [default $_GET] - Haystack
*
* (string) Si no existe devuelve (string) '', si sí existe devuelve el elemento.
*/
function v($element, $array = array()){
  if(!count($array)){
    $array = $_POST;
  }
  $i = i($element, $array);
  return ( $i ? $i : '');
}

/*
* () generateRandomString
* Genera un string aleatorio
*
* @params $length (int) [default 8] - Longitud del string
*
* (string) String aleatorio
*
* Nota: No usar para string encriptados.
*/
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
