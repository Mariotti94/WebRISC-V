<?php
session_start();
require 'functions.php';
do {
	require 'engine.php';
} while(!$_SESSION['finito']);
?>
