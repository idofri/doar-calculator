<?php

namespace Doar\Services;

class DoarServicePrice
{
    use DoarServiceTrait;

    protected $Pweight;
    protected $Pqty;
    protected $Pprice;
    protected $Ptotal;
    protected $commentsNo;
    protected $comments = [];

    /**
     * @return string
     */
    public function getPriceWeight()
    {
        return $this->Pweight;
    }

    /**
     * @return int
     */
    public function getPriceQuantity()
    {
        return (int) $this->Pqty;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return (float) $this->Pprice;
    }

    /**
     * @return float
     */
    public function getPriceTotal()
    {
        return (float) $this->Ptotal;
    }

    /**
     * @return int
     */
    public function getCommentTotal()
    {
        return (int) $this->commentsNo;
    }

    /**
     * @return array
     */
    public function getComments()
    {
        return $this->comments;
    }
}
