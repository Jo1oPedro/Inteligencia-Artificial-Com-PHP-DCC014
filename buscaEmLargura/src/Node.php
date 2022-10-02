<?php

namespace src;

use SplFixedArray;

class Node {

    // "?" means that it can be null
    private ?Node $previous = null;
    private ?Node $next = null;
    private mixed $matrix;
    private int $rule = 1;
    private int $numberToInsert = 1;

    public function __construct()
    {
        $this->alreadyInserted = new SplFixedArray(9);
        $this->matrix = new SplFixedArray(3);
        foreach($this->matrix as $key => $array) {
            $this->matrix[$key] = new SplFixedArray(3);
        }
    }

    /**
     * Define o nó anterior
     */
    public function setPrevious(Node &$node): void 
    {
        $this->previous = $node;
    }

    /**
     * Retorna o nó anterior
     */
    public function getPrevious(): ?Node 
    {
        return $this->previous;
    }

    /**
     * Define o proximo nó
     * @param null|Node $node
     */
    public function setNext(Node &$node = null): void 
    {
        $this->next = $node;
    }

    /**
     * Retorna o proximo nó
     */
    public function getNext(): ?Node
    {
        return $this->next;
    }

    /**
     * Constroi a matriz baseada na matriz do nó anterior;
     */
    public function setMatrix(mixed $matrix): void 
    {
        foreach($matrix as $key => $array) {
            foreach($array as $key2 => $element) {
                $this->matrix[$key][$key2] = $element;
            }
        }
    }

    /**
     * Retorna a matriz do nó
     */
    public function getMatrix(): mixed
    {
        return $this->matrix;
    }

    /**
     * Define a regra atual do nó
     */
    public function setRule(int $rule): void
    {
        $this->rule = $rule;
    }

    /**
     * Retorna a regra atual do nó
     */
    public function getRule(): int 
    {
        return $this->rule;
    }

    public function setNumberToInsert(int $numberToInsert): void 
    {
        $this->numberToInsert = $numberToInsert;
    }

    public function getNumberToInsert(): int 
    {
        return $this->numberToInsert;
    }

}
