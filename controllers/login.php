<?php

$view = 'login';

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if ($username) {
    $user = getInstance($userModel, md5($username));

    if (is_null($user)) {
        $vars['error'] = 'User not found';
    } else if ($username === $user['username'] && $password === $user['password']) {
        $_SESSION['username'] = $username;
    } else {
        $vars['error'] = 'Username and Password mismatch';
    }
}

if (isset($_SESSION['username'])) {
    $vars['username'] = $_SESSION['username'];
    $view = 'welcome';
}
