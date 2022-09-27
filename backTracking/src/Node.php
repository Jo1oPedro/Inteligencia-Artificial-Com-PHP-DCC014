<?php

namespace src;

use SplFixedArray;

class Node {

    // "?" means that it can be null
    private ?Node $previous = null;
    private ?Node $next = null;
    private mixed $matrix;

    public function __construct()
    {
        $this->matrix = new SplFixedArray(3);
        foreach($this->matrix as $key => $array) {
            $this->matrix[$key] = new SplFixedArray(3);
        }
    }

    public function setPrevious(Node &$node = null): void 
    {
        $this->previous = $node;
    }

    public function getPrevious(): ?Node 
    {
        return $this->previous;
    }

    public function setNext(Node &$node): void 
    {
        $this->next = $node;
    }

    public function getNext(): Node
    {
        return $this->next;
    }

    public function setMatrix(mixed $matrix): void 
    {
        foreach($matrix as $key => $array) {
            foreach($array as $key2 => $element) {
                $this->matrix[$key][$key2] = $element;
            }
        }
    }

    public function getMatrix(): mixed
    {
        return $this->matrix;
    }

}
