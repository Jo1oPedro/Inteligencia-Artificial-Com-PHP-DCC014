<?php

namespace src;

class Tree {

    private $root;
    
    public function __construct(/*?Node &$node = null*/)
    {
        //$this->root = $node;
        $this->root = new Node();
        $this->root->getMatrix()[0][0] = 1;
        $this->root->setLastInsertedColumn(0);
        $this->root->setLastInsertedLine(0);
        $this->root->getAlreadyInserted()[0] = 1;
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
        $currentNode->setMatrix($this->root->getMatrix());
        $allSumsEquals15 = 0;
        do {
            $newNodeFlag = true;
            $this->rules($currentNode);
            $newNode = new Node();
            if($currentNode->getRule() >= 10) {
                if($this->allSumsEquals15($currentNode->getMatrix())) {
                    return;
                }
                $previousNode = $currentNode->getPrevious();
                $previousNode->setNext($newNode);
                $newNode->
                //$newNode //= &$previousNode;
                //$newNode->setNumberToInsert($currentNode->getNumberToInsert());
                $currentNode = null;
                //$newNodeFlag = false;
            } if($allSumsEquals15 == 2) {
                echo "dale";
                die();
                $currentNode->setNext($newNode);
                $newNode->setPrevious($currentNode);
                $newNode->setRule($currentNode->getRule());
                //$newNode->setRule($currentNode->getRule());
            } else if(/*$currentNode->getRule() <= 9 ||*/ !$allSumsEquals15) {
                $previousNode = $currentNode->getPrevious();
                $previousNode->setNext($newNode);
                $newNode->setRule($currentNode->getRule());
                //$newNode->setRule($currentNode->getRule());
                $currentNode = null;
            }
            $currentNode = &$newNode;
            if($newNodeFlag) {
                $currentNode->newNode($currentNode->getPrevious());
            }
            //$this->rules($currentNode);
            $allSumsEquals15 = $this->allSumsEquals15($currentNode->getMatrix());
            /*if(!$allSumsEquals15) {
                $newNode = new Node();
                $previousNode = $currentNode->getPrevious();
                $previousNode->setNext($newNode);
                $newNode->setPrevious($previousNode);
                $currentNode = &$newNode;
                $currentNode->newNode($currentNode->getPrevious());
            }*/
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
            $numOfElements = count($array);
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
                $currentNode->setRule($currentNode->getRule()+1);
                if(!$currentNode->getMatrix()[0][0]) {
                    $currentNode->getMatrix()[0][0] = $currentNode->getNumberToInsert();
                } else {
                    $this->rules($currentNode);
                }
                $currentNode->setLastInsertedColumn(0);
                $currentNode->setLastInsertedLine(0);
                //$this->printMatrix($currentNode->getMatrix());
                break;
            case 2:
                $currentNode->setRule($currentNode->getRule()+1);
                if(!$currentNode->getMatrix()[0][1]) {
                    $currentNode->getMatrix()[0][1] = $currentNode->getNumberToInsert();
                } else {
                    $this->rules($currentNode);
                }
                $currentNode->setLastInsertedColumn(1);
                $currentNode->setLastInsertedLine(0);
                //$this->printMatrix($currentNode->getMatrix());
                break;
            case 3:
                //echo "dale";
                die();
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
