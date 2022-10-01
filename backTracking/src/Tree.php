<?php

namespace src;

class Tree {

    private $root;
    
    public function __construct(/*?Node &$node = null*/)
    {
        //$this->root = $node;
        $this->root = new Node();
        //$this->root->getMatrix()[0][0] = 1;
        //$this->root->setLastInsertedColumn(0);
        //$this->root->setLastInsertedLine(0);
        //$this->root->getAlreadyInserted()[0] = 1;
        $this->root->setRule(2);
    }

    public function backtracking(): void
    {
        $currentNode = new Node();
        $this->root->setNext($currentNode);
        $currentNode->setPrevious($this->root); 
        //$currentNode->setAlreadyInserted($this->root->getAlreadyInserted());
        //$currentNode->setLastInsertedColumn($this->root->getLastInsertedColumn());
        //$currentNode->setLastInsertedLine($this->root->getLastInsertedLine());
        //$currentNode->setMatrix($this->root->getMatrix());
        $allSumsEquals15 = 0;
        $contadora = 0;
        do {
            $this->rules($currentNode);
            //$this->printMatrix($currentNode->getMatrix());
            $currentNode->setRule($currentNode->getRule()+1);
            $allSumsEquals15 = $this->allSumsEquals15($currentNode->getMatrix());
            if(($allSumsEquals15 == 2) || (!$allSumsEquals15)) {
                if($contadora == 1) {
                    echo "dale" . PHP_EOL;
                    $this->printMatrix($currentNode->getMatrix());
                    echo "dale2" . PHP_EOL;
                }
                $newNode = new Node();
                if($contadora == 1) {
                    echo "dale" . PHP_EOL;
                    $this->printMatrix($currentNode->getMatrix());
                    echo "dale2" . PHP_EOL;
                    die();
                }
                if($currentNode->getRule() >= 10) {
                    $newNode = &$currentNode->getPrevious();
                    $currentNode = null;
                } else if($allSumsEquals15 == 2) {
                    $currentNode->setNext($newNode);
                    $newNode->setPrevious($currentNode);
                    $newNode->setMatrix($currentNode->getMatrix());
                    $newNode->setNumberToInsert($currentNode->getNumberToInsert() + 1);
                } else {
                    $this->printMatrix($currentNode->getMatrix());
                    die();
                    $previousNode = $currentNode->getPrevious();
                    $previousNode->setNext($newNode);
                    $newNode->setNumberToInsert($currentNode->getNumberToInsert());
                    $newNode->setMatrix($previousNode->getMatrix());
                    $currentNode = null;
                }
                $currentNode = &$newNode;
            }
            $contadora++;
        } while(($allSumsEquals15 == 2) || (!$allSumsEquals15));
    }

    private function allSumsEquals15(mixed $matrix): int 
    {
        $notCompletedYet = false;

        $sumAllLines = $this->sumAllLines($matrix);
        if($sumAllLines == 2) {
            $notCompletedYet = true;
        } else if(!$sumAllLines) {
            return 0;
        }

        $sumAllColumns = $this->sumAllColumns($matrix);
        if($sumAllColumns == 2) {
            $notCompletedYet = true;
        } else if(!$sumAllColumns) {
            return 0;
        }

        $sumAllDiagonals = $this->sumAllDiagonals($matrix);
        if($sumAllDiagonals == 2) {
            $notCompletedYet = true;
        } else if(!$sumAllDiagonals) {
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
            $numOfElements = $this->count($array);
            if($numOfElements == 2 || $numOfElements == 3) {
                $contadora = 0;
                foreach($array as $element) {
                    $contadora += $element;
                }
                if(($numOfElements == 3 && $contadora != 15) || ($numOfElements == 2 && $contadora < 6)) {
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
                if($numberOfElementsColumn == 2) {
                    if($contadora < 6) {
                        return 0;
                    }
                }
                $numberOfElementsColumn = 0;
                $notFullFieldYet = true;
                continue;
            }
            if($contadora != 15) {
                return 0;
            }
        }
        if($notFullFieldYet) {
            return 2;
        }
        return 1;
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
        if(!($numberOfElementsDiagonal == 3)) {
            if($numberOfElementsDiagonal == 2) {
                if($contadora < 6) {
                    return 0;
                }
            }
            return 2;
        }
        if($contadora != 15) {
            return 0;
        }
        $numberOfElementsDiagonal = 0;
        $contadora = 0;
        $column = 2;
        for($contadora = 0; $contadora < 3; $contadora--) {
            if($matrix[$key][$key]) {
                $numberOfElementsDiagonal++;
                $contadora += $matrix[$contadora][$column--]; 
            }
        }   
        if(!$numberOfElementsDiagonal == 3) {
            if($numberOfElementsDiagonal == 2) {
                if($contadora < 6) {
                    return 0;
                }
            }
            return 2;
        }
        if($contadora != 15) {
            return 0;
        }
        return 1;
    }

    public function rules(/*int $rule,*/ Node &$currentNode): void 
    {
        switch($currentNode->getRule()) {
            case 1:
                if(!$currentNode->getMatrix()[0][0]) {
                    $currentNode->getMatrix()[0][0] = $currentNode->getNumberToInsert();
                } else {
                    $currentNode->setRule($currentNode->getRule()+1);
                    $this->rules($currentNode);
                }
                break;
            case 2:
                if(!$currentNode->getMatrix()[0][1]) {
                    $currentNode->getMatrix()[0][1] = $currentNode->getNumberToInsert();
                } else {
                    $currentNode->setRule($currentNode->getRule()+1);
                    $this->rules($currentNode);
                }
                break;
            case 3:
                if(!$currentNode->getMatrix()[0][2]) {
                    $currentNode->getMatrix()[0][2] = $currentNode->getNumberToInsert();
                } else {
                    $currentNode->setRule($currentNode->getRule()+1);
                    $this->rules($currentNode);
                }
                break;
            case 4:
                if(!$currentNode->getMatrix()[1][0]) {
                    $currentNode->getMatrix()[1][0] = $currentNode->getNumberToInsert();
                } else {
                    $currentNode->setRule($currentNode->getRule()+1);
                    $this->rules($currentNode);
                }
                break;    
            case 5:
                if(!$currentNode->getMatrix()[1][1]) {
                    $currentNode->getMatrix()[1][1] = $currentNode->getNumberToInsert();
                } else {
                    $currentNode->setRule($currentNode->getRule()+1);
                    $this->rules($currentNode);
                }
                break;
            case 6:
                if(!$currentNode->getMatrix()[1][2]) {
                    $currentNode->getMatrix()[1][2] = $currentNode->getNumberToInsert();
                } else {
                    $currentNode->setRule($currentNode->getRule()+1);
                    $this->rules($currentNode);
                }
                break;
            case 7:
                if(!$currentNode->getMatrix()[2][0]) {
                    $currentNode->getMatrix()[2][0] = $currentNode->getNumberToInsert();
                } else {
                    $currentNode->setRule($currentNode->getRule()+1);
                    $this->rules($currentNode);
                }
                break;
            case 8:
                if(!$currentNode->getMatrix()[2][1]) {
                    $currentNode->getMatrix()[2][1] = $currentNode->getNumberToInsert();
                } else {
                    $currentNode->setRule($currentNode->getRule()+1);
                    $this->rules($currentNode);
                }
                break;
            case 9:
                if(!$currentNode->getMatrix()[2][2]) {
                    $currentNode->getMatrix()[2][2] = $currentNode->getNumberToInsert();
                } else {
                    $currentNode->setRule($currentNode->getRule()+1);
                    $this->rules($currentNode);
                }
                break;
        }
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
                echo '|' . (($matrix[$key][$key2]) ?? 0)  . '|';
            } 
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

}
