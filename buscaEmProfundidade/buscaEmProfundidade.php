<?php

require_once "autoload.php";

use src\Tree;

/*
$array = ["dale", "doly", "dele", "duly"];

unset($array[3]);

foreach($array as $key => $element) {
    echo "Chave: " . $key . " elemento: " . $element . PHP_EOL;
}

$array[] = "uhsdgu";

foreach($array as $key => $element) {
    echo "Chave: " . $key . " elemento: " . $element . PHP_EOL;
}

echo array_key_last($array);
*/


$start_time = microtime(true);

$arvore = new Tree();

$arvore->buscaEmProfundidade();

$end_time = microtime(true);

echo $execution_time = ($end_time - $start_time);