<?php

namespace src;

use SplFixedArray;
use SplQueue;

class Node {

    // "?" means that it can be null
    private ?Node $previous = null;
    private ?Node $next = null;
    private mixed $matrix;
    private int $rule = 1;
    private int $lastInsertedLine = 0;
    private int $lastInsertedColumn = 0;
    private mixed $alreadyInserted;
    private mixed $atLeast6;

    public function __construct()
    {
        $this->alreadyInserted = new SplFixedArray(9);
        $this->matrix = new SplFixedArray(3);
        foreach($this->matrix as $key => $array) {
            $this->matrix[$key] = new SplFixedArray(3);
        }
        //$this->atLeast6 = new SplFixedArray(8);
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
     */
    public function setNext(Node &$node): void 
    {
        $this->next = $node;
    }

    /**
     * Retorna o proximo nó
     */
    public function getNext(): Node
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

    /**
     * Define a ultima linha em que um valor for inserido na matriz
     */
    public function setLastInsertedLine(int $line): void
    {
        $this->lastInsertedLine = $line;
    }

    /**
     * Retorna a ultima linha em que um valor for inserido na matriz
     */
    public function getLastInsertedLine(): int
    {
        return $this->lastInsertedLine;
    }

    /**
     * Define a ultima coluna em que um valor foi inserido na matriz
     */
    public function setLastInsertedColumn(int $column): void
    {
        $this->lastInsertedColumn = $column;
    }

    /**
     * Retorna a ultima coluna em que um valor foi inserido na matriz
     */
    public function getLastInsertedColumn(): int
    {
        return $this->lastInsertedColumn;
    }

    /**
     * Seta no vetor do node quais valores já foram inseridos(1, 2, 3, ...)
     */
    public function setAlreadyInserted(mixed $alreadyInserted): void
    {
        foreach($alreadyInserted as $key => $element) {
            $this->alreadyInserted[$key] = $element;
        }
    }

    /**
     * Retorna o vetor contendo quais valores já foram inseridos nesse nó
     */
    public function getAlreadyInserted(): mixed
    {
        return $this->alreadyInserted;
    }
}
