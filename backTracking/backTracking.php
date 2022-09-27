<?php

require_once "autoload.php";

use src\Tree;
use src\Node;

$arvore = new Tree();
$node = new Node();

//$arvore->dale();
$matrix = new SplFixedArray(3);
foreach($matrix as $key => $item) {
    $matrix[$key] = new SplFixedArray(3);
    foreach($matrix[$key] as $key2 => $element) {
        $matrix[$key][$key2] = $key+1 * $key2;
    }
}

$node->setMatrix($matrix);

$node2 = new Node();

foreach($matrix as $key => $item) {
    $matrix[$key] = new SplFixedArray(3);
    foreach($matrix[$key] as $key2 => $element) {
        $matrix[$key][$key2] = (($key+1)*3) * $key2;
    }
}

$node2->setMatrix($matrix);

$matrix = $node2->getMatrix();

print_r($matrix);

$matrix[2][2] = 1233;

print_r($node2->getMatrix());
