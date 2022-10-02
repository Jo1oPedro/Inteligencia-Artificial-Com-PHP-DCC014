<?php

require_once "autoload.php";

use src\Tree;
use src\Node;

/*$node = new Node();
$node2 = new Node();
$node->setNext($node2);
$node->getNext()->getMatrix()[0][0] = 19;
$node2->getMatrix()[2][2] = 47;
print_r($node2->getMatrix());
print_r($node->getNext()->getMatrix());
die();*/

$start_time = microtime(true);

$arvore = new Tree();

$arvore->buscaEmLargura();

$end_time = microtime(true);

echo $execution_time = ($end_time - $start_time);

