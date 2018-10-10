<?php

function getModel($modelName) {
    $model = file_get_contents(__DIR__ . '/models/' . $modelName . '.model');
    return preg_split("/\R/", $model);
}

function getInstance($modelName) {
    $model = getModel($modelName);

    $data = file_get_contents(__DIR__ . '/data/' . $modelName . '.data');
    $data = preg_split("/\R/", $data);

    $instance = [];
    
    foreach ($model as $propertyName) {
        $propertyValue = null;

        foreach ($data as $d) {
            $d = explode(":", $d);

            if ($d[0] === $propertyName) {
                $propertyValue = $d[1];
                break;
            }
        }

        $instance[$propertyName] = $propertyValue;
    }

    return $instance;
}

function saveInstance($modelName, $instance) {
    $model = getModel($modelName);
    
    $data = [];

    foreach ($model as $propertyName) {
        $data[] = $propertyName . ':' . $instance[$propertyName];
    }

    return file_put_contents(
        __DIR__ . '/data/' . $modelName . '.data',
        implode("\n", $data)
    );
}

function getSalt($SaltWithHash) {
    $array = explode("+", $SaltWithHash); // Разделяем соль от хеша
    return $array[0];
}

function getHash($SaltWithHash) {
    $array = explode("+", $SaltWithHash); // Разделяем соль от хеша
    return $array[1];
}
