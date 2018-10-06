<?php

$view = 'login';

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if ($username) { 
    $salt = getSalt($user['password']);
    $hash = getHash($user['password']);
    
    if ($username === $user['username'] && md5($salt.$password) === $hash) {
        $_SESSION['username'] = $username;
    } else {
        $vars['error'] = 'Username and Password mismatch';
    }
}

if (isset($_SESSION['username'])) {
    $vars['username'] = $_SESSION['username'];
    $view = 'welcome';
}
