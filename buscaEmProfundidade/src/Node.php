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
    private mixed $sons;
    private int $numberOfSons = 0;
    private int $lastSonCaught = 0; 
    private bool $invalidNode = false;

    public function __construct()
    {
        $this->matrix = new SplFixedArray(3);
        foreach($this->matrix as $key => $array) {
            $this->matrix[$key] = new SplFixedArray(3);
        }
        $this->sons = new SplFixedArray(9);
    }

    /**
     * Define o nó anterior
     * @param Node $node
     */
    public function setPrevious(Node $node): void 
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
    public function setNext(Node $node = null): void 
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
     * Constrói a matriz baseada na matriz do nó anterior;
     * @param mixed $matrix
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
     * @param int $rule
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
     * Seta o número que o nó atual irá inserir
     * @param int $numberToInsert
     */
    public function setNumberToInsert(int $numberToInsert): void 
    {
        $this->numberToInsert = $numberToInsert;
    }

    /**
     * Recupera o número que o nó atual irá inserir
     */
    public function getNumberToInsert(): int 
    {
        return $this->numberToInsert;
    }

    /**
     * Seta os filhos do nó pai
     * @param Node $nodeSon
     */
    public function setSon(Node $nodeSon): void 
    {
        $this->sons[$this->numberOfSons] = $nodeSon;
        $this->numberOfSons++;
    } 

    /**
     * Retorna o filho especificado do nó atual
     * @param int $position
     */
    public function getSon(int $position): ?Node
    {
        return $this->sons[$position];
    }

    public function getLastSon(): ?Node
    {
        return $this->sons[$this->lastSonCaught];
        $this->lastSonCaught++;
    }

    /**
     * Retorna o número de filhos atuais no nó
     */
    public function getNumberOfSons(): int
    {
        return $this->numberOfSons;
    }

    /**
     * Seta o node como invalido.
     */
    public function setInvalidNode(): void 
    {   
        $this->invalidNode = true;
    }

    public function getInvalidNode(): bool
    {
        return $this->invalidNode;
    }


}
