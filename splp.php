<?php

include 'bootstrap.php';

$app = new App(
    new Services\Input($argv),
    new Services\Configuration(require 'config.php'),
    new Services\Counter()
);
$app->run();
