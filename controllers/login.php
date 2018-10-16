<?php

$salt = 'k23n561nk';
$view = 'login';
$username = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;
if ($username) {
    foreach ($user as $value) {
        if ($username === $value['login'] && md5($password . $salt) === $value['password']) {
            $_SESSION['login'] = $username;
            $vars['login'] = $username;
            $view = 'welcome';
        } else {
            $vars['error'] = 'Username and password mismatch!';
        }
    }
}
if(isset($_SESSION['login'])) {
    $vars['login'] = $_SESSION['login'];
    $view = 'welcome';
}
