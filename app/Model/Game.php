<?php

namespace App\Model;

class Game
{
    /**
     * @var PieceSet
     */
    private $table;

    /**
     * @var Player
     */
    private $players;

    /**
     * @var PieceSet
     */
    private $pile;

    /**
     * @var bool
     */
    private $finish = false;

   public function start($player1, $player2){
       $this->initialize($player1, $player2);
       $this->output("Game starting with<br> table now {$this->table}<br>");
       while (!$this->finish) {
           /** @var Player $player */
           foreach ($this->players as $player) {
               try {
                   $this->turn($player);
                   $this->output("Table is now {$this->table}.<br>");
                   $this->checkForWinner($player);
                   $this->checkForPiecesInPile();
                   if ($this->finish) {
                       break;
                   }
               } catch (\Exception $exception) {
                   $this->output($exception->getMessage());
               }
           }
       }
   }



    /**
     * @param Player $player
     * @throws \Exception
     */
    private function turn(Player $player) {
        $piece = null;
        $position = PieceSet::POSITION_NONE;

        while (empty($piece) && !empty($this->pile)) {

            list($position, $piece) = $player->move($this->table->head(), $this->table->tail());

            if (empty($piece)) {

                $pieceFromStock = $this->startPieces();
                $player->prependPiece($pieceFromStock);
                $this->output("$player can't play, drawing piece $pieceFromStock <br>");
            }
        }

        if (!empty($piece)) {
            $this->output("$player plays --> $piece<br>");
            $this->table->add($position, $piece);
        }
    }

    /**
     * @return mixed
     */
    private function choosingPieces(){
        //get all pieces of domino
        $data = $this->all_pieces;

        $pieces = [];
        for ($init = 0; $init <= 6; $init++){
            //generate a rand number
            $select = array_rand($this->all_pieces,1);
            //remove the piece choose
            unset($this->all_pieces[$select]);

            $dados = explode(':',$data[$select] );
            $piece = new Piece($dados[0],$dados[1]);

            //add piece in array
            $pieces[$init] = $piece;
        }
        return $pieces;
    }

    //chose the piece for starter game
    private function startPieces(){

            $data = $this->all_pieces;
            //generate a rand number
            $select = array_rand($this->all_pieces,1);
            //remove the piece choose
            unset($this->all_pieces[$select]);
            //add piece in array
            $dados = explode(':',$data[$select] );
            $piece = new Piece($dados[0],$dados[1]);

        return $piece;
    }

    /**
     * @return mixed
     */
    private function mountLot(){
        //get all pieces of domino
        $allPieces = $this->all_pieces;
        $init = 0;
        foreach ($allPieces as $piece){
            $dados = explode(':',$piece );
            $data = new Piece($dados[0],$dados[1]);
            $pieces[$init] = $data;
            $init++;
        }

        return new PieceSet($pieces);
    }

    public function initialize($player1, $player2)
    {
        //create player
        $this->players[] = new Player(
            $player1,
           new PieceSet($this->choosingPieces())
        );
        //create player
        $this->players[] = new Player(
            $player2,
           new PieceSet($this->choosingPieces())
        );
        //set the piece for game starter
        $this->table = new PieceSet();
        $this->table->append($this->startPieces());

        //add the pieces remaining in pile
        $this->pile = $this->mountLot();
    }

    private function checkForWinner(Player $player)
    {
        if ($player->isOutOfPieces()) {
            $this->output("<br><h3>Player $player has won.</h3><br>");
            $this->finish = true;
        }
    }


    private function checkForPiecesInPile()
    {
        if ($this->pile->isEmpty()) {
            $this->output("Looks like we are out of pile, nobody wins.<br>");
            $this->finish = true;
        }
    }

    private function output($message)
    {
        echo "$message\n\n";
    }

    private $all_pieces = [
                '1' => "0:0",
                "2" => "0:1",
                "3" => "0:2",
                "4" => "0:3",
                "5" => "0:4",
                "6" => "0:5",
                "7" => "0:6",
                "8" => "1:1",
                "9" => "1:2",
                "10" => "1:3",
                "11" => "1:4",
                "12" => "1:5",
                "13" => "1:6",
                "14" => "2:2",
                "15" => "2:3",
                "16" => "2:4",
                "17" => "2:5",
                "18" => "2:6",
                "19" => "3:3",
                "20" => "3:4",
                "21" => "3:5",
                "22" => "3:6",
                "23" => "4:4",
                "24" => "4:5",
                "25" => "4:6",
                "26" => "5:5",
                "27" => "5:6",
                "28" => "6:6"
                ];


    /**
     * @return Player
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param Player $players
     */
    public function setPlayers($players)
    {
        $this->players = $players;
    }

    /**
     * @return PieceSet
     */
    public function getPile()
    {
        return $this->pile;
    }

    /**
     * @param PieceSet $pile
     */
    public function setPile($pile)
    {
        $this->pile = $pile;
    }


}


