<?php

function getModel($modelName) {
    $properties = file_get_contents(__DIR__ . '/models/' . $modelName . '.model');
    $properties = preg_split("/\R/", $properties);

    $model = [
        '__MODEL__' => $modelName,
        'properties' => $properties,
    ];

    return $model;
}

function getInstance($model, $id) {
    $modelName = $model['__MODEL__'];
    $data = file_get_contents(
        __DIR__ . '/data/'
        . $modelName . '/'
        . $id . '.data'
    );

    if ($data === false) {
        return null;
    }

    $data = explode("\n", $data);

    $instance = [];
    
    foreach ($model['properties'] as $propertyName) {
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

    $instance['id'] = $id;

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
