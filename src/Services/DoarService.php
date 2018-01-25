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
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStatusDescription()
    {
        return $this->statusDesc;
    }

    /**
     * @return string
     */
    public function getMenuItem()
    {
        return $this->mitem;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @return string
     */
    public function getCname()
    {
        return $this->cname;
    }

    /**
     * @return int
     */
    public function getPcode()
    {
        return $this->pcode;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->qty;
    }

    /**
     * @return array
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @return int
     */
    public function getCommentTotal()
    {
        return $this->commTextsNo;
    }

    /**
     * @return array
     */
    public function getComments()
    {
        return $this->commTexts;
    }

    /**
     * @param \stdClass $std
     *
     * @return DoarService
     */
    public function newFromStd(\stdClass $std)
    {
        $instance = new static();

        foreach ((array) $std as $attribute => $value) {
            if ('prices' === $attribute && is_array($value)) {
                foreach ($value as $price) {
                    $servicePrice = new DoarServicePrice();
                    foreach ($price as $priceAttribute => $priceAttributeValue) {
                        if ('comments' === $priceAttribute) {
                            foreach ($priceAttributeValue as $comment) {
                                $priceComment = new DoarServiceComment();
                                foreach ($comment as $commentAttribute => $commentAttributeValue) {
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
                foreach ($value as $comment) {
                    $serviceComment = new DoarServiceComment();
                    foreach ($comment as $commentAttribute => $commentAttributeValue) {
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
