<?php
require_once 'functions.php';

generateAliases();

$filename = dirname(__DIR__) . '/bin/aliases';
$file = fopen($filename, 'w+');

fwrite($file, implode(PHP_EOL, $aliases));

fclose($file);

