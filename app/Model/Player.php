<?php

namespace App\Model;

class Player
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var PieceSet
     */
    private $pieces;

    /**
     * Player constructor.
     * @param $name
     * @param $pieces
     */
    public function __construct($name,PieceSet $pieces)
    {
        $this->name = $name;
        $this->pieces = $pieces;
    }

    /**
     * @param $head
     * @param $tail
     * @return array
     */
    public function move($head, $tail) {
        $position = PieceSet::POSITION_NONE;
        $result = null;

        /** @var Piece $piece */
        foreach ($this->pieces->all() as $key => $piece) {
            $position = $piece->matches($head, $tail);
            if ($position != PieceSet::POSITION_NONE) {
                $result = $piece;
                $this->pieces->remove($key);
                break;
            }
        }
        return [$position, $result];
    }

    /**
     * @return bool
     */
    public function isOutOfPieces() {
        return $this->pieces->isEmpty();
    }

    /**
     * @param Piece $piece
     */
    public function prependPiece(Piece $piece) {
        $this->pieces->prepend($piece);
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return PieceSet
     */
    public function getPieces()
    {
        return $this->pieces;
    }

    /**
     * @param PieceSet $pieces
     */
    public function setPieces($pieces)
    {
        $this->pieces = $pieces;
    }

}