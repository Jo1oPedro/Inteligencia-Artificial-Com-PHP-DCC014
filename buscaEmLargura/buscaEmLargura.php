<?php

require_once "autoload.php";

use src\Tree;

/*$array = ["dale"];

for($contadora = 0; $contadora < count($array); $contadora++) {
    $array[$contadora+1] = "dale123123";
    echo $contadora+1 . PHP_EOL; 
}

echo $array[1];*/

/*$array = ["dale", "dale2", "dale3"];

unset($array[0]);
$array = array_values($array);

foreach($array as $key => $dale) {
    echo $key . PHP_EOL;
    echo $dale . PHP_EOL;
}*/

$start_time = microtime(true);

$arvore = new Tree();

$arvore->buscaEmLargura();

$end_time = microtime(true);

echo $execution_time = ($end_time - $start_time);

/*
use src\Node;

$arvore = new Tree();
$node = new Node();
$node2 = new Node();

$node->setSon($node2);

$node2->getMatrix()[0][0] = 5;
$node2->getMatrix()[2][2] = 9;
print_r($node->getSon(0)->getMatrix());

echo "Trocou a matriz" . PHP_EOL;

print_r($node2->getMatrix());

echo "Trocou a matriz" . PHP_EOL;

$node->getSon(0)->getMatrix()[2][2] = 15;
$node->getSon(0)->getMatrix()[0][0] = -8;
$node->getSon(0)->getMatrix()[1][1] = 25;
print_r($node2->getMatrix());

echo "Trocou a matriz" . PHP_EOL;

$node2->getMatrix()[0][0] = -90;
$node2->getMatrix()[1][1] = 50;
$node2->getMatrix()[2][2] = 128;

print_r($node->getSon(0)->getMatrix());
*/
