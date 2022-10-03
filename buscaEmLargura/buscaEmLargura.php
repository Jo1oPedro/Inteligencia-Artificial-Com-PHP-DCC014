<?php

require_once "autoload.php";

use src\Tree;

$start_time = microtime(true);

$arvore = new Tree();

$arvore->buscaEmLargura();

$end_time = microtime(true);

echo $execution_time = ($end_time - $start_time);

