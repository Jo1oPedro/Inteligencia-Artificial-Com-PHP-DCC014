<?php

namespace src;

class Tree {

    private $root;
    
    public function __construct(?Node &$node = null)
    {
        $this->root = $node;
    }

    public function backtracking(): void
    {
        $currentNode = $this->root; 
        do {
            $currentNodeRule = $currentNode->getRule();
            $this->rules($currentNodeRule, $currentNode);
            $this->root->setRule(++$currentNodeRule);
        } while(!$this->allSumsEquals15($currentNode->getMatrix()));
    }

    private function allSumsEquals15(mixed $matrix): bool 
    {
        if(!$this->sumAllLines($matrix)) {
            return false;
        }
        if(!$this->sumAllColumns($matrix)) {
            return false;
        }
        if(!$this->sumAllDiagonals($matrix)) {
            return false;
        }
        return true;   
    }

    private function sumAllLines(mixed $matrix): bool
    {
        foreach($matrix as $array) {
            $contadora = 0;
            foreach($array as $element) {
                $contadora += $element;
            }
            if($contadora != 15) {
                return false;
            }
        }
        return true;
    }

    private function sumAllColumns(mixed $matrix): bool 
    {
        foreach($matrix as $key => $array) {
            $contadora = 0;
            foreach($array as $key2 => $element) {
                $contadora += $matrix[$key2][$key];
            }
            if($contadora != 15) {
                return false;
            }
        }
        return true;
    }

    private function sumAllDiagonals(mixed $matrix): bool
    {
        $contadora = 0;
        foreach($matrix as $key => $array) {
            $contadora += $matrix[$key][$key];
        }
        if($contadora != 15) {
            return false;
        }
        $contadora = 0;
        $column = 1;
        for($contadora = count($matrix)-1; $contadora >= 0; $contadora--) {
            $contadora +=  $matrix[$contadora][$column++]; 
        }   
        if($contadora != 15) {
            return false;
        }
    }

    public function rules(int $rule, Node $currentNode) 
    {
        switch($rule) {
            case 1:
                $matrix = $currentNode->getMatrix();
                $line = $currentNode->lastInsertedLine;
                $column = $currentNode->lastInsertedColumn;
                if($column == 0 && $line == 1) {
                    $line = 3;
                    $column = 3;
                }
                break;
        }
    }
}
