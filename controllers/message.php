<?php

foreach ($message as $value) {
    if ($_SESSION['login'] === $value['login']) {
        $add_content = $_POST['message'] ?? null;
        if($add_content) {
            saveInstance($add_content, $value['login']);
            $value['message'] = $add_content;
        }
        $vars['login'] = $value['login'];
        $vars['message'] = $value['message'];
        $view = 'message';
        break;
    }
    else {
        $view = 'login';
    }
}
