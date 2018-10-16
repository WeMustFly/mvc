<?php
require_once "controllers/db.php";
function getUserFromDb($modelName) {
    $data = R::getAll('select * from users');
    $arr1 = [];
    $arr2 = [];
    $users = [];
    $propertyValue = null;
    $model = getModel($modelName);
    foreach ($data as $d) {
        foreach ($d as $key => $value) {
            if ($key === $model[0]) {
                $propertyValue = $value;
                $arr2 = [$model[0] => $propertyValue];
            }
            if ($key === $model[1]) {
                $propertyValue = $value;
                $arr1 = [$model[1] => $propertyValue];
                array_push($users, $arr2 + $arr1);
            }
        }
    }
    return $users;
}

function getModel($modelName) {
    $model = file_get_contents(__DIR__ . '/models/' . $modelName . '.model');
    $model = preg_split("/\R/", $model);
    return $model;
}

function saveInstance($instance, $login)
{
    $sQuery = "UPDATE users SET message='$instance' WHERE login='$login'";
    R::exec( $sQuery );
}

