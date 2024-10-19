<?php

require __DIR__.'/../vendor/autoload.php';

use Data\Data;

$output = new Data('    local - username    ');

$data = $output->trim()->toUpper()->explode('-');

print_r($data);

?>