<?php

$view = 'mainpage';



if(isset($_SESSION['login'])) {
    $vars['login'] = $_SESSION['login'];
    $view = 'welcome';
}