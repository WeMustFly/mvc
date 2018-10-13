<?php 

define('DEFAULT_CONTROLLER', 'login');
if (!file_exists('controllers/' . DEFAULT_CONTROLLER . '.php')) {
    die('DEFAULT_CONTROLLER doesn\'t exist');
}

include_once('functions.php');

session_start();

$user = getInstance('User');
$message = getInstance('Message');

$controller = $_GET['controller'] ?? DEFAULT_CONTROLLER;
$controller = file_exists('controllers/' . $controller . '.php') 
    ? $controller
    : DEFAULT_CONTROLLER;

$view = 'login';
$vars = [
    'error' => '',
];

include_once('controllers/' . $controller . '.php');

// Template Engine
$content = file_get_contents(__DIR__ . '/views/' . $view . '.html');
foreach ($vars as $key => $value) {
    $content = str_replace('{{'.$key.'}}', $value, $content);
}
echo $content;
