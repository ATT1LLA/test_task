<?php

class Pawn extends Figure {
    public function __toString() {
        return $this->isBlack ? '♟' : '♙';
    }

    /*  flag is bool type, telling if the square [xTo, yTo] is empty or not
        This func returns:
            - 0 if we can't make move
            - 1 if we can move without capturing any enemy piece
            - 2 if we capture enemy piece
    */
    public function checkPawnMove ($xFrom, $yFrom, $xTo, $yTo, $flag, $flagAdditional) {
        // Checking if it's a pawn
        if ($this->__toString() === '♟' || $this->__toString() === '♙') {

            $xDelta = abs(ord($xTo) - ord($xFrom));
            $yDelta = ($this->isBlack ? $yFrom - $yTo : $yTo - $yFrom);

            switch ($xDelta) {
                case 0:
                    if ($flag) return 0;
                    else {
                        switch ($yDelta) {
                            case 2:
                                // Keeping in mind that yTo can't be equal to 9 or 0
                                // It has been checked in func move
                                if (($yFrom == 7 || $yFrom == 2) && !$flagAdditional) return 1;
                                else return 0;
                            case 1:
                                return 1;
                            default:
                                return 0;
                        }
                    }
                case 1:
                    if ($flag) {
                        if ($xDelta === 1) return 2;
                        else return 0;
                        }
                    else return 0;
                default:
                    return 0;
            }
        } else {
            // We don't want to check anything if it's not a pawn
            return 1;
        }
    }
}
