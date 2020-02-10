<?php
session_start();
require_once 'functions.php';
do {
  require 'engine.php';
} while( !$_SESSION['data'][$_SESSION['index']]['finito'] && !$_SESSION['data'][0]['sysHold'] && !empty($_SESSION['memIstrDim']));
require_once 'schema.php';
?>
