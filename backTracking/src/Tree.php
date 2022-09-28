<?php

namespace src;

class Tree {

    private $root;
    
    public function __construct(/*?Node &$node = null*/)
    {
        //$this->root = $node;
        $this->root = new Node();
        $this->root->getMatrix()[2][2] = 1;
        $this->root->setLastInsertedColumn(2);
        $this->root->setLastInsertedLine(2);
        $this->root->getAlreadyInserted()[0] = 1;
        $this->root->setRule(2);
    }

    public function backtracking(): void
    {
        $currentNode = new Node();
        $this->root->setNext($currentNode);
        $currentNode->setPrevious($this->root); 
        $currentNode->setAlreadyInserted($this->root->getAlreadyInserted());
        $currentNode->setLastInsertedColumn($this->root->getLastInsertedColumn());
        $currentNode->setLastInsertedLine($this->root->getLastInsertedLine());
        $currentNode->setMatrix($this->root->getMatrix());
        do {
            //$currentNodeRule = $currentNode->getRule();
            $this->rules(/*$currentNodeRule,*/ $currentNode);
            var_dump($currentNode->getMatrix());
            die();
            //$this->root->setRule(++$currentNodeRule);
            
        } while(!$this->allSumsEquals15($currentNode->getMatrix()));
    }

    private function allSumsEquals15(mixed $matrix): int 
    {
        $notCompletedYet = false;
        if($this->sumAllLines == 2) {
            $notCompletedYet = true;
            //return 2;
        } 
        if(!$this->sumAllLines) {
            return 0;
        }
        if($this->sumAllColumns == 2) {
            $notCompletedYet = true;
            //return 2;
        }
        if(!$this->sumAllColumns) {
            return 0;
        }
        if($this->sumAllDiagonals == 2) {
            $notCompletedYet = true;
            //return 2;
        }
        if(!$this->sumAllDiagonals) {
            return 0;
        }
        if($notCompletedYet) {
            return 2;
        }
        return 1;   
    }

    private function sumAllLines(mixed $matrix): int
    {
        $notFullFieldYet = false;
        foreach($matrix as $array) {
            if(count($array) == 3) {
                $contadora = 0;
                foreach($array as $element) {
                    $contadora += $element;
                }
                if($contadora != 15) {
                    return 0;
                }
            } else {
                $notFullFieldYet = true;
                continue;
            }
        }
        if($notFullFieldYet) {
            return 2;
        }
        return 1;
    }

    private function sumAllColumns(mixed $matrix): int 
    {
        $notFullFieldYet = false;
        $numberOfElementsColumn = 0;
        foreach($matrix as $key => $array) {
            $contadora = 0;
            foreach($array as $key2 => $element) {
                if($element) {
                    $numberOfElementsColumn++;
                    $contadora += $matrix[$key2][$key];
                }
            }
            if($numberOfElementsColumn < 3) {
                $numberOfElementsColumn = 0;
                $notFullFieldYet = true;
                continue;
            }
            if($contadora != 15) {
                return false;
            }
        }
        if($notFullFieldYet) {
            return 2;
        }
        return true;
    }

    private function sumAllDiagonals(mixed $matrix): int
    {
        $contadora = 0;
        $numberOfElementsDiagonal = 0;
        foreach($matrix as $key => $array) {
            if($matrix[$key][$key]) {
                $numberOfElementsDiagonal++;
                $contadora += $matrix[$key][$key];
            }
        }
        if(!$numberOfElementsDiagonal == 3) {
            return 2;
        }
        if($contadora != 15) {
            return false;
        }
        $numberOfElementsDiagonal = 0;
        $contadora = 0;
        $column = 1;
        for($contadora = count($matrix)-1; $contadora >= 0; $contadora--) {
            if($matrix[$key][$key]) {
                $numberOfElementsDiagonal++;
                $contadora +=  $matrix[$contadora][$column++]; 
            }
        }   
        if(!$numberOfElementsDiagonal == 3) {
            return 2;
        }
        if($contadora != 15) {
            return false;
        }
        return true;
    }

    public function rules(/*int $rule,*/ Node &$currentNode): int 
    {
        switch($currentNode->getRule()) {
            case 1:
                // mover para a esquerda
                $matrix = $currentNode->getMatrix();
                $line = $currentNode->getLastInsertedLine();
                $column = $currentNode->getLastInsertedColumn();
                if($column == 0 && $line == 0) {
                    echo "entrou1";
                    $line = 2;
                    $column = 2;
                } else if($column == 0 && $line == 1) {
                    echo "entrou2";

                    $line = 0;
                    $column = 2;
                } else if($column == 0 && $line == 2) {
                    echo "entrou3";

                    $line = 1;
                    $column = 2;
                } else {
                    $column--;
                }
                $numberOfElementsAlreadyInserted = $this->count($currentNode->getAlreadyInserted()) + 1;
                if(!$currentNode->getMatrix()[$line][$column]) {
                    $currentNode->getMatrix()[$line][$column] = $numberOfElementsAlreadyInserted;
                    $currentNode->getAlreadyInserted()[$numberOfElementsAlreadyInserted - 1] = $numberOfElementsAlreadyInserted;
                    //var_dump($currentNode->getAlreadyInserted());
                    //var_dump($numberOfElementsAlreadyInserted);
                    $this->printMatrix($currentNode->getMatrix());
                    die();
                } else {
                    $this->rules($currentNode);
                }
                $currentNode->setRule($currentNode->getRule() + 1);
                if($numberOfElementsAlreadyInserted >= 2) {
                    if(!$this->validateAtLeast6($currentNode->getMatrix())) {
                        if($currentNode->getRule() == 10) {
                            return false;
                        }
                        $this->rules($currentNode);
                    }
                }
                $currentNode->setLastInsertedColumn = $column;
                $currentNode->setLastInsertedLine - $line;
                break;
            /*case 2:
                //mover para cima e esquerda
                $matrix = $currentNode->getMatrix();
                $line = $currentNode->lastInsertedLine;
                $column = $currentNode->lastInsertedColumn;

                break;*/
        }
    }

    private function validateAtLeast6(mixed $matrix) 
    {
        $sameLine = 0;
        foreach($matrix as $key => $array) {
            if(!(count($array) >= 2)) {
                continue;
            }
            foreach($array as $key2 => $element) {
                if($element) {
                    $sameLine += $array[$key2]; 
                }
            }

        }
        return true;
    } 

    private function count(mixed $alreadInserted): int
    {
        $contadora = 0;
        foreach($alreadInserted as $element) {
            if($element) {
                $contadora++;
            }
        }
        return $contadora;
    }

    private function printMatrix(mixed $matrix) 
    {
        foreach($matrix as $key => $array) {
            foreach($array as $key2 => $element) {
                echo '|' . ($matrix[$key][$key2]) ?? "0" . '|';
            } 
            echo PHP_EOL;
        }
    }

}
