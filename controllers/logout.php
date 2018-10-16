<?php

$view = 'login';
if (isset($_SESSION['login'])) {
    unset($_SESSION['login']);
}
