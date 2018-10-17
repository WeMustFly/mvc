<?php

require_once "db.php";
$view = 'signup';
$tmp_data = $_POST;
$errors = [];
$salt = 'k23n561nk';
$username = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

if(isset($tmp_data['SignUp'])) {
    if(trim($tmp_data['login']) === '') {
        $errors[] = 'Type Login';
    }
    if(trim($tmp_data['email']) === '') {
        $errors[] = 'Type email';
    }
    if($tmp_data['password'] === '') {
        $errors[] = 'Type password';
    }
    if($tmp_data['password_2'] !== $tmp_data['password']) {
        $errors[] = 'Second password is wrong';
    }
    if(R::count('users', "login = ?", array($tmp_data['login'])) > 0) {
        $errors[] = 'Login already used';
    }
    if(R::count('users', "email = ?", array($tmp_data['email'])) > 0) {
        $errors[] = 'E-mail already used';
    }
    if(empty($errors)) {
        $user = R::dispense('users');
        $user->login = $tmp_data['login'];
        $user->email = $tmp_data['email'];
        $user->password = md5($tmp_data['password'].$salt);
        $user->message = null;
        R::store($user);
        echo '<div style="color:lawngreen;">'.'Registration Complete'. '<a href="/index.php?controller=mainpage"> Go Home</a>' . '</div><hr>';

    } else {
        echo '<div style="color:red;">'.array_shift($errors). '<a href="/index.php?controller=mainpage"> Go Home</a>' .'</div><hr>';
    }
}