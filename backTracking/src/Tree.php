<?php

namespace src;

class Tree {

    private $root;
    private $contadoraGlobal = 0;

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
        $allSumsEquals15 = 0;
        $contadora = 0;
        do {
            $this->rules($currentNode);
            $this->contadoraGlobal = $contadora;
            echo $contadora .PHP_EOL;
            $this->printMatrix($currentNode->getMatrix());
            //$currentNode->setRule($currentNode->getRule()+1);
            $allSumsEquals15 = $this->allSumsEquals15($currentNode->getMatrix());
            if($contadora == 170) {
                echo "dale -1";
                //die();
            }
            if(($allSumsEquals15 == 2) || (!$allSumsEquals15)) {
                ${"newNode" . "$contadora"} = new Node();
                if($currentNode->getRule() >= 10 /*&& $allSumsEquals15 != 2*/) {
                    if($contadora == 66) {
                        echo "dale";
                        //die();
                    }
                    if($contadora == 334) {
                        echo "Tá na contadora: " . $contadora . PHP_EOL;
                        $this->printMatrix($currentNode->getMatrix());
                        echo $currentNode->getPrevious()->getRule() . PHP_EOL;
                        echo $currentNode->getPrevious()->getNumberToInsert() . PHP_EOL;
                        echo "dale2";
                        die();
                    }
                    $currentNode->setRule($currentNode->getRule()+1);
                    ${"newNode" . "$contadora"} = $currentNode->getPrevious();
                    ${"newNode" . "$contadora"}->setMatrix(${"newNode" . "$contadora"}->getPrevious()->getMatrix());
                } else if($allSumsEquals15 == 2) {
                    if($contadora == 66) {
                        echo "dale3";
                        //die();
                    }
                    if($contadora == 334) {
                        echo "dale4" . PHP_EOL;
                        $this->printMatrix($currentNode->getMatrix());
                        echo $currentNode->getRule() . PHP_EOL;
                        echo $currentNode->getNumberToInsert() . PHP_EOL;
                        die();
                    }
                    $currentNode->setRule($currentNode->getRule()+1);
                    $currentNode->setNext(${"newNode" . "$contadora"});
                    ${"newNode" . "$contadora"}->setPrevious($currentNode);
                    ${"newNode" . "$contadora"}->setMatrix($currentNode->getMatrix());
                    ${"newNode" . "$contadora"}->setNumberToInsert($currentNode->getNumberToInsert() + 1);
                    
                } else {
                    if($contadora == 66) {
                        echo "dale5";
                        //die();
                    }
                    if($contadora == 334) {
                        echo "dale6" . PHP_EOL;
                        $this->printMatrix($currentNode->getMatrix());
                        echo $currentNode->getRule() . PHP_EOL;
                        echo $currentNode->getNumberToInsert() . PHP_EOL;
                        die();
                    }
                    $currentNode->setRule($currentNode->getRule()+1);
                    $previousNode = $currentNode->getPrevious();
                    $previousNode->setNext(${"newNode" . "$contadora"});
                    ${"newNode" . "$contadora"}->setPrevious($previousNode);
                    ${"newNode" . "$contadora"}->setNumberToInsert($currentNode->getNumberToInsert());
                    ${"newNode" . "$contadora"}->setMatrix($previousNode->getMatrix());
                    ${"newNode" . "$contadora"}->setRule($currentNode->getRule());
                    $currentNode = null;
                    if($contadora == 65) {
                        echo "dale3" . PHP_EOL;
                        $this->printMatrix(${"newNode" . "$contadora"}->getMatrix());
                        //die();
                    }
                }
                $currentNode = ${"newNode" . "$contadora"};
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
        if($this->contadoraGlobal == 334) {
            echo "Valor do sumAllLines: " . $sumAllLines . PHP_EOL;
        }
        $sumAllColumns = $this->sumAllColumns($matrix);
        if($this->contadoraGlobal == 334) {
            echo "Valor do sumAllColumns: " . $sumAllColumns . PHP_EOL;
        }
        if($sumAllColumns == 2) {
            $notCompletedYet = true;
        } else if(!$sumAllColumns) {
            return 0;
        }
        if($this->contadoraGlobal == 170) {
            echo "dale 10" . PHP_EOL;
            //die();
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
            if($this->contadoraGlobal == 170) {
                //echo $numOfElements . PHP_EOL;
            }
            if($numOfElements == 2 || $numOfElements == 3) {
                $contadora = 0;
                foreach($array as $element) {
                    $contadora += $element;
                }
                if(($numOfElements == 3 && $contadora != 15) || ($numOfElements == 2 && $contadora < 6)) {
                    return 0;
                } else if($numOfElements == 2 && $contadora >= 6) {
                    $notFullFieldYet = true;
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
                if($matrix[$key2][$key]) {
                    $numberOfElementsColumn++;
                    $contadora += $matrix[$key2][$key];
                }
            }
            if($this->contadoraGlobal == 334) {
                echo "Contadora: " . $contadora . PHP_EOL;
            }
            if($this->contadoraGlobal == 170) {
                echo $numberOfElementsColumn . PHP_EOL;
                //echo $contadora . PHP_EOL;
                //die();
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
        for($key = 0; $key < 3; $key++) {
            if($matrix[$key][$column]) {
                $numberOfElementsDiagonal++;
                $contadora += $matrix[$key][$column]; 
            }
            $column--;
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
                echo "DALE 123" . PHP_EOL;
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
                }
                echo "DALE 123" . PHP_EOL;
                /*else {
                    $currentNode->setRule($currentNode->getRule()+1);
                    $this->rules($currentNode);
                }*/
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
