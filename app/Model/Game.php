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
       $this->output("Game starting with first tile : {$this->table}");

//       var_dump($data);
       while (!$this->finish) {
           /** @var Player $player */
           foreach ($this->players as $player) {
               try {

                   $this->turn($player);
                   $this->output("Table is now {$this->table}.");
                   $this->checkForWinner($player);
                   $this->checkForPiecesInStock();

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

                $pieceFromStock = $this->pile->getRandomPiece();
                $player->prependPiece($pieceFromStock);
                $this->output("$player can't play, drawing tile $pieceFromStock");
            }
        }

        if (!empty($piece)) {
            $this->output("$player plays --> $piece");
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
            //add piece in array
            $pieces[$init] = $data[$select];
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
        return $pieces = $data[$select];
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
        $this->pile = $this->all_pieces;
    }

    private function checkForWinner(Player $player)
    {
        if ($player->isOutOfPieces()) {
            $this->output("Player $player has won.");
            $this->finish = true;
        }
    }


    private function checkForPiecesInStock()
    {
        if ($this->pile->isEmpty()) {
            $this->output("Looks like we are out of pile, nobody wins.");
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


