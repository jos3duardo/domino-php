<?php


namespace App\Model;

/**
 * Class PieceSet
 * @package App\Model
 */
class PieceSet
{

    const POSITION_NONE = 0;
    const POSITION_HEAD = 1;
    const POSITION_TAIL = 2;

    /**
     * @var array
     */
    private $piece;

    /**
     * PieceSet constructor.
     * @param array $piece
     */
    public function __construct(array $piece)
    {
        $this->piece = $piece;
    }

    /**
     * @param $position
     * @param $piece
     * @throws \Exception
     */
    public function add($position, $piece){
        switch ($position) {
            case self::POSITION_NONE:
                throw new \Exception("Adding $piece in an unknown position");
            case self::POSITION_HEAD:
                $this->prepend($piece);
                break;
            case self::POSITION_TAIL:
                $this->append($piece);
                break;
        }
    }

    public function prepend(Piece $piece)
    {
        array_unshift($this->piece, $piece);
        return $this;
    }

    /**
     * @param Piece $piece
     * @return $this
     */
    public function append(Piece $piece)
    {
        $this->piece[] = $piece;
        return $this;
    }

    /**
     * @return Piece
     */
    public function getRandomPiece(): Piece
    {
        $result = $this->getRandomPieces(1);
        return $result[0];
    }

    /**
     * @param $amount
     * @return array
     */
    public function getRandomPieces($amount): array
    {
        $result = [];
        $keys = array_rand($this->piece, $amount);
        if ($amount == 1) {
            $keys = [$keys];
        }
        foreach ($keys as $key) {
            $result[] = $this->piece[$key];
            unset($this->piece[$key]);
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function isEmpty() {
        return empty($this->piece);
    }

    /**
     * @return mixed
     */
    public function head() {
        return $this->piece[0]->head();
    }

    /**
     * @return mixed
     */
    public function tail() {
        return $this->piece[count($this->piece) - 1]->tail();
    }

    /**
     * @param $key
     */
    public function remove($key) {
        if (isset($this->piece[$key])) {
            unset($this->piece[$key]);
        }
    }

    /**
     * @return array
     */
    public function all() {
        return $this->piece;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return implode(' ', $this->piece);
    }

}