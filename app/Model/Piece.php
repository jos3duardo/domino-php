<?php

namespace App\Model;


class Piece
{

    private $head;

    private $tail;

    /**
     * Piece constructor.
     * @param $head
     * @param $tail
     */
    public function __construct($head, $tail)
    {
        $this->head = $head;
        $this->tail = $tail;
    }

    /**
     * @param $head
     * @param $tail
     * @return int
     */
    public function matches($head, $tail) {

        if ($this->tail() === $head || $this->flip()->tail() === $head) {
            return PieceSet::POSITION_HEAD;
        }

        if ($this->head() === $tail || $this->flip()->head() === $tail) {
            return PieceSet::POSITION_TAIL;
        }
        return PieceSet::POSITION_NONE;
    }
    /**
     * @return int
     */
    public function head() {
        return $this->head;
    }

    /**
     * @return int
     */
    public function tail() {
        return $this->tail;
    }

    /**
     * @return $this
     */
    public function flip()
    {
        $tempHead = $this->head;
        $this->head = $this->tail;
        $this->tail = $tempHead;
        return $this;
    }

    public function __toString()
    {
        return "[ {$this->head}:{$this->tail} ]";
    }

    /**
     * @return mixed
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * @param mixed $head
     */
    public function setHead($head): void
    {
        $this->head = $head;
    }

    /**
     * @return mixed
     */
    public function getTail()
    {
        return $this->tail;
    }

    /**
     * @param mixed $tail
     */
    public function setTail($tail): void
    {
        $this->tail = $tail;
    }


}