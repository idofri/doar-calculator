<?php

namespace Doar\Services;

class DoarServiceComment
{
	use DoarServiceTrait;
	
	protected $cno;
	protected $ctext;
	
	/**
	 * @access public
     * @return int
     */
	public function getCommentNumber()
	{
		return (int) $this->cno;
	}
	
	/**
	 * @access public
     * @return string
     */
	public function getCommentText()
	{
		return $this->ctext;
	}
}
