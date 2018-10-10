<?php
function getModel($modelName){
    $model = file_get_contents(__DIR__ . '/models/' . $modelName . '.model');
    $model = preg_split("/\R/", $model);
    return $model;
}

function getInstance($modelName) {
    $model = getModel($modelName);
    $data = file_get_contents(__DIR__ . '/data/' . $modelName . '.data');

    $data = explode("\n", $data);

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
