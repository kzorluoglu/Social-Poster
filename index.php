<?php
session_start();

require_once 'vendor/autoload.php';


/**
 * development|production|test
 */

define('CURRENT_ENV', 'development');

$base = new \d8devs\socialposter\Base();
$base->run();
?>
