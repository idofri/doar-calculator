<?php

namespace Doar\Services;

class DoarServiceComment
{
    use DoarServiceTrait;

    protected $cno;
    protected $ctext;

    /**
     * @return int
     */
    public function getCommentNumber()
    {
        return (int) $this->cno;
    }

    /**
     * @return string
     */
    public function getCommentText()
    {
        return $this->ctext;
    }
}
