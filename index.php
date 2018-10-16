<?php
include_once('functions.php');
session_start();

$user = getUserFromDb('User');
$message = getUserFromDb('Message');

$controllers = [
    'mainpage',
    'login',
    'signup',
    'welcome',
    'message',
    'logout',
];

$controller = $_GET['controller'] ?? 'mainpage';
$controller = in_array($controller, $controllers)
    ? $controller
    : $controllers[0];

$view = 'mainpage';
$vars = [
    'error' => ''
];

include_once('controllers/' . $controller . '.php');

// Template Engine
$content = file_get_contents(__DIR__ . '/views/' . $view . '.html');
foreach ($vars as $key => $value) {
    $content = str_replace('{{'.$key.'}}', $value, $content);

}
echo $content;
