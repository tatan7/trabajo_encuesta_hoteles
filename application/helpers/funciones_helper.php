<?php 
function getIP(){
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
            return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
        } else {
            return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
        }
    }
}
function traducirMes($mes) {
    //realizo el switch de la variable del mes para traducirlo a espaï¿½ol
    switch ($mes) {
        CASE '01':$mes = 'Enero';
            Break;
        CASE '02':$mes = 'Febrero';
            Break;
        CASE '03':$mes = 'Marzo';
            Break;
        CASE '04':$mes = 'Abril';
            Break;
        CASE '05':$mes = 'Mayo';
            Break;
        CASE '06':$mes = 'Junio';
            Break;
        CASE '07':$mes = 'Julio';
            Break;
        CASE '08':$mes = 'Agosto';
            Break;
        CASE '09':$mes = 'Septiembre';
            Break;
        CASE '10':$mes = 'Octubre';
            Break;
        CASE '11':$mes = 'Noviembre';
            Break;
        CASE '12':$mes = 'Diciembre';
            Break;
    }
    return $mes;
}
function formatoFechaEspanol($fechaDb) 
{
    $dateUnix = strtotime($fechaDb);
    $anoDoc = date("Y", $dateUnix);
    $perDoc = date("m", $dateUnix);
    $dia = date("d", $dateUnix);
    return $dia . " de " . TraducirMes($perDoc) . " del " . $anoDoc;
}
function formatoFechaEspanolHora($fechaDb,$salida=true) {
    $dateUnix = strtotime($fechaDb);
    $anoDoc = date("Y", $dateUnix);
    $perDoc = date("m", $dateUnix);
    $dia = date("d", $dateUnix);
    $hora = date("H", $dateUnix);
    $min = date("i", $dateUnix);
    if($salida)
    {
        echo $dia . " de " . TraducirMes($perDoc) . " del " . $anoDoc." a las ".$hora.":".$min;
    }
    else
    {
        return $dia . " de " . TraducirMes($perDoc) . " del " . $anoDoc." a las ".$hora.":".$min;   
    }
}
 ?>