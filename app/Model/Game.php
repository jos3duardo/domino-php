<?php

namespace App\Model;
/**
 * Class Game
 * @package App\Model
 */
class Game
{
    /**
     * @var array
     */
    private $table;

    /**
     * @var Player
     */
    private $players;

    /**
     * @var array
     */
    private $lot;

    /**
     * @var bool
     */
    private $finish = false;



   public function start(){
       $this->initGame();

   }




    private function initGame(){
        $piecesJson = file_get_contents(__DIR__."../pieces.json");
        $pieces = json_decode($piecesJson);

        return $pieces;
    }

}