<?php

date_default_timezone_set('America/Sao_Paulo');

function logar( $nomeParam, $msgv )
{
  global $WWW_ROOT;

  $arq = $WWW_ROOT . 'logs/';
  $arq .=  date_format( date_create()  , 'Ymd-H') . "0000-";
  $arq .= $nomeParam . '.log' ;
  
  $log = "# " . date_format( date_create()  , 'd/m/Y H:i:s') . "; $msgv \n";
  
  
  file_put_contents( $arq, $log, FILE_APPEND );
  
}


?>
