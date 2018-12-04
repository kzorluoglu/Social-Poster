<?php
session_start();
require_once 'vendor/autoload.php';
$base = new \d8devs\socialposter\Base();
$base->run();
?>