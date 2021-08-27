<?php

include_once  dirname(__DIR__) . '/vendor/autoload.php';
use Celf\Core\procesos\novedadReclamos\ActualizarReclamos;

define ( 'VENDOR_HOME' , dirname(__DIR__) . '/vendor');

//se reciben pagos de préstamos.
$task = new ActualizarReclamos();
$task->process(dirname(__DIR__). "/cron/");
?>