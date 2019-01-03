<?php
session_start();

require_once 'vendor/autoload.php';


$response = new \D8devs\SocialPoster\Response();
$response->render();

