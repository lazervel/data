<?php

require __DIR__.'/../vendor/autoload.php';

use Data\Data;

$out = Data::input('/home/root/dir/focus')->explode('/')->push('last', 'log');

print_r($out);

?>