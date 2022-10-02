<?php

namespace src;

use SplFixedArray;

class Tree {

    private $root;
    private mixed $openNodes = [];
    private $contadoraGlobal = 0;

    public function __construct()
    {
        $this->root = new Node();
        $this->openNodes[0] = $this->root;
    }

    public function buscaEmLargura(): void
    {
        $allSumsEquals15 = 0;
        $contadoraName = 0;
        do {
            if($this->openNodes[0]->getMagicSquareCompleted()) {
                break;
            }
            for($contadora = 1; $contadora < 10; $contadora++) {
                ${"newNode" . "$contadoraName"} = new Node();
                ${"newNode" . "$contadoraName"}->setRule($contadora);
                ${"newNode" . "$contadoraName"}->setMatrix($this->openNodes[0]->getMatrix());
                if($this->openNodes[0] != $this->root) {
                    ${"newNode" . "$contadoraName"}->setNumberToInsert($this->openNodes[0]->getNumberToInsert()+1);
                } else {
                    ${"newNode" . "$contadoraName"}->setNumberToInsert(1);
                }
                $this->rules(${"newNode" . "$contadoraName"});
                $allSumsEquals15 = (${"newNode" . "$contadoraName"}->getInvalidNode()) ? 0 : $this->allSumsEquals15(${"newNode" . "$contadoraName"}->getMatrix());
                if($allSumsEquals15) {
                    if($allSumsEquals15 == 1) {
                        ${"newNode" . "$contadoraName"}->setMagicSquareCompleted();  
                    }
                    $this->openNodes[0]->setSon(${"newNode" . "$contadoraName"});
                    ${"newNode" . "$contadoraName"}->setPrevious($this->openNodes[0]);
                    $this->openNodes[] = ${"newNode" . "$contadoraName"};
                } 
                $contadoraName++;
            }
            unset($this->openNodes[0]);
            $this->openNodes = array_values($this->openNodes);
            } while(true);
        $this->printMatrix($this->openNodes[0]->getMatrix());
        echo "Quadrado mágico concluído!" . PHP_EOL;
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
        foreach($matrix as $key => $array) {
            $contadora = 0;
            $numberOfElementsColumn = 0;
            foreach($array as $key2 => $element) {
                if($matrix[$key2][$key]) {
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
        $return2Flag = false;
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
            $return2Flag = true;
        } else {
            if($contadora != 15) { 
                return 0;
            }
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
            //return 2;
            $return2Flag = true;
        } else {
            if($contadora != 15) { 
                return 0;
            }
        }
        return ($return2Flag) ? 2 : 1;
    }

    public function rules(Node &$currentNode): void 
    {
        switch($currentNode->getRule()) {
            case 1:
                if(!$currentNode->getMatrix()[0][0]) {
                    $currentNode->getMatrix()[0][0] = $currentNode->getNumberToInsert();
                    return;
                }
                $currentNode->setInvalidNode();
                break;
            case 2:
                if(!$currentNode->getMatrix()[0][1]) {
                    $currentNode->getMatrix()[0][1] = $currentNode->getNumberToInsert();
                    return;
                }
                $currentNode->setInvalidNode();
                break;
            case 3:
                if(!$currentNode->getMatrix()[0][2]) {
                    $currentNode->getMatrix()[0][2] = $currentNode->getNumberToInsert();
                    return;
                }
                $currentNode->setInvalidNode();
                break;
            case 4:
                if(!$currentNode->getMatrix()[1][0]) {
                    $currentNode->getMatrix()[1][0] = $currentNode->getNumberToInsert();
                    return;
                }
                $currentNode->setInvalidNode();
                break;    
            case 5:
                if(!$currentNode->getMatrix()[1][1]) {
                    $currentNode->getMatrix()[1][1] = $currentNode->getNumberToInsert();
                    return;
                }
                $currentNode->setInvalidNode();
                break;
            case 6:
                if(!$currentNode->getMatrix()[1][2]) {
                    $currentNode->getMatrix()[1][2] = $currentNode->getNumberToInsert();
                    return;
                }
                $currentNode->setInvalidNode();
                break;
            case 7:
                if(!$currentNode->getMatrix()[2][0]) {
                    $currentNode->getMatrix()[2][0] = $currentNode->getNumberToInsert();
                    return;
                }
                $currentNode->setInvalidNode();
                break;
            case 8:
                if(!$currentNode->getMatrix()[2][1]) {
                    $currentNode->getMatrix()[2][1] = $currentNode->getNumberToInsert();
                    return;
                }
                $currentNode->setInvalidNode();
                break;
            case 9:
                if(!$currentNode->getMatrix()[2][2]) {
                    $currentNode->getMatrix()[2][2] = $currentNode->getNumberToInsert();
                    return;
                }
                $currentNode->setInvalidNode();
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
