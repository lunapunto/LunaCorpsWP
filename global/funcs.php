<?php
/*
* Funciones globales
* A diferencia de prefuncs son funciones que son globales pero son secundarias
* Llama a prefuncs
*/
require_once('prefuncs.php');

/*
* () pc_money
* Formatea una cantidad en Moneda
*
* %parent () get_part
*
* @params $qty (int) [obligatorio] - Cantidad
* @params $currency (string) [default 'MXN'] - Terminación de cantidad
*
* (string) Devuelve la cantidad formateada
*/
function pc_money($qty, $currency = 'MXN'){
    $qty = round($qty);
    return '$'.number_format($qty,2).' '.$currency;
}

/*
* () str_to_array
* Convierte un string a un array delimitado por un string
* A diferencia de explode() realiza un filtro después
*
* @params $str (string) [obligatorio] - String
* @params $delimiter (string) [default ','] - Delimitador
*
* (array) Devuelve un array con los substr
*/
function str_to_array($str, $delimiter = ','){
    $str = trim($str);
    $exploded = explode($delimiter,$str);
    $exploded = array_filter($exploded);
    return $exploded;
}

/*
* () array_to_str
* Convierte un array a un string separados por un string ($glue)
* A diferencia de implode() filtra el array resultante
*
* @params $array (array) [obligatorio] - Array de entrada
* @params $glue(string) [default ','] - String que une
*
* (string) Devuelve un string unido
*/
function array_to_str($array,$glue = ','){
    $array = array_filter($array);
    $imploded = implode($glue,$array);
    return $imploded;
}

/*
* () pdate
* Devuelve una fecha formateada
* Acepta todos los formatos de fecha y tiempo
*
* @params $tiemstamp (mixed) [Default time()] - String o int de tiempo o fecha
* @params $istime (bool) [Default true] - Dice si es fecha UNIX (time())
*
* (string) Devuelve la fecha formateada
*/
function pdate($timestamp = '', $istime = true){
    $months = array();
    $months[] = 'enero';
    $months[] = 'febrero';
    $months[] = 'marzo';
    $months[] = 'abril';
    $months[] = 'mayo';
    $months[] = 'junio';
    $months[] = 'julio';
    $months[] = 'agosto';
    $months[] = 'septiembre';
    $months[] = 'octubre';
    $months[] = 'noviembre';
    $months[] = 'diciembre';
    if(!$timestamp){
      $timestamp = time();
      $istime = true;
    }
    if($istime){
       $ts = $timestamp;
    }else{
      $ts = strtotime($timestamp);
    }
    $month = date('n',$ts);
    $month = $months[$month-1];
    $day = date('j',$ts);
    $year = date('Y',$ts);

    $h = date('H:i',$ts).'hrs.';

    return $day.' de '.$month.' del '.$year.', '.$h;
}
