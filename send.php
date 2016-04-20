<?php

$loader = require __DIR__ . '/vendor/autoload.php';
$loader->add('Lift\\', __DIR__);

$elevator = Lift\Building::getElevator();
$elevator->send();