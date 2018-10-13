<?php

$view = 'registration';

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if ($username) {
    $id = md5($username);
    if (!existsIstance('User', $id)) {
        $data['username'] = $username;
        $data['password'] = $password;
        if (saveInstance('User', $data, $id)) {
            $_SESSION['username'] = $username;
        }
    } else {
        $vars['error'] = 'User already exists';
    }
}

if (isset($_SESSION['username'])) {
    $vars['username'] = $_SESSION['username'];
    $view = 'welcome';
}
