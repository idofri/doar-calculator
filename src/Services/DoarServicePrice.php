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
	 * @access public
     * @return string
     */
	public function getPriceWeight()
	{
		return $this->Pweight;
	}
	
	/**
	 * @access public
     * @return int
     */
	public function getPriceQuantity()
	{
		return (int) $this->Pqty;
	}
	
	/**
	 * @access public
     * @return float
     */
	public function getPrice()
	{
		return (float) $this->Pprice;
	}
	
	/**
	 * @access public
     * @return float
     */
	public function getPriceTotal()
	{
		return (float) $this->Ptotal;
	}
	
	/**
	 * @access public
     * @return int
     */
	public function getCommentTotal()
	{
		return (int) $this->commentsNo;
	}
	
	/**
	 * @access public
     * @return array
     */
	public function getComments()
	{
		return $this->comments;
	}
}
