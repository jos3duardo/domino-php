<?php

namespace App\Model;

class Player
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var Piece
     */
    private $pieces;

    /**
     * Player constructor.
     * @param $name
     * @param Piece $pieces
     */
    public function __construct($name,Piece $pieces)
    {
        $this->name = $name;
        $this->pieces = $pieces;
    }


}