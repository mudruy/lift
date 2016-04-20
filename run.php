<?php

set_time_limit(0);
ob_implicit_flush();
        
$loader = require __DIR__ . '/vendor/autoload.php';
$loader->add('Lift\\', __DIR__);

$elevator = Lift\Building::getElevator();
$elevator->run();