<?php

namespace Doar\Services;

class DoarService
{
	use DoarServiceTrait;
	
	protected $status;
	protected $statusDesc;
	protected $mitem;
	protected $service;
	protected $cname;
	protected $pcode;
	protected $weight;
	protected $qty;
	protected $prices = [];
	protected $commTextsNo;
	protected $commTexts = [];
	
	/**
	 * @access public
     *
     * @return int
     */
	public function getStatus()
	{
		return $this->status;
	}
	
	/**
	 * @access public
     *
     * @return string
     */
	public function getStatusDescription()
	{
		return $this->statusDesc;
	}
	
	/**
	 * @access public
     *
     * @return string
     */
	public function getMenuItem()
	{
		return $this->mitem;
	}
	
	/**
	 * @access public
     *
     * @return string
     */
	public function getService()
	{
		return $this->service;
	}
	
	/**
	 * @access public
     *
     * @return string
     */
	public function getCname()
	{
		return $this->cname;
	}
	
	/**
	 * @access public
     *
     * @return int
     */
	public function getPcode()
	{
		return $this->pcode;
	}
	
	/**
	 * @access public
     *
     * @return int
     */
	public function getWeight()
	{
		return $this->weight;
	}
	
	/**
	 * @access public
     *
     * @return int
     */
	public function getQuantity()
	{
		return $this->qty;
	}
	
	/**
	 * @access public
     *
     * @return array
     */
	public function getPrices()
	{
		return $this->prices;
	}
	
	/**
	 * @access public
     *
     * @return int
     */
	public function getCommentTotal()
	{
		return $this->commTextsNo;
	}
	
	/**
	 * @access public
     *
     * @return array
     */
	public function getComments()
	{
		return $this->commTexts;
	}
	
	/**
     * @access public
     * @param  \stdClass $std
     * @return DoarService
     */
	public function newFromStd(\stdClass $std)
    {
        $instance = new static;

        foreach ( (array) $std as $attribute => $value)
        {
			if ('prices' === $attribute && is_array($value)) {
				foreach ($value as $price)
				{
					$servicePrice = new DoarServicePrice;
					foreach ($price as $priceAttribute => $priceAttributeValue)
					{
						if ('comments' === $priceAttribute) {
							foreach ($priceAttributeValue as $comment) 
							{
								$priceComment = new DoarServiceComment;
								foreach ($comment as $commentAttribute => $commentAttributeValue)
								{
									$priceComment->setAttribute($commentAttribute, $commentAttributeValue);
								}
								$servicePrice->setAttribute($priceAttribute, $priceComment);
							}
						} else {
							$servicePrice->setAttribute($priceAttribute, $priceAttributeValue);
						}
					}
					$instance->setAttribute($attribute, $servicePrice);
				}
			} elseif ('commTexts' === $attribute && is_array($value)) {
				foreach ($value as $comment)
				{
					$serviceComment = new DoarServiceComment;
					foreach ($comment as $commentAttribute => $commentAttributeValue)
					{
						$serviceComment->setAttribute($commentAttribute, $commentAttributeValue);
					}
					$instance->setAttribute($attribute, $serviceComment);
				}
			} else {
				$instance->setAttribute($attribute, $value);
			}
        }

        return $instance;
    }
}
