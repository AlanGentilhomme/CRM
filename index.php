<?php
ini_set('display_errors', 'on');
include 'Controller/Controller.php';
$controller = new Controller();

$controller->dispatch();