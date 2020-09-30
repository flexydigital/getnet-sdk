<?php

namespace Getnet\API;

class MarketplaceSubsellerPayments implements \JsonSerializable
{

    use ToStringJsonTrait;
    
    /**
     * @var float $subseller_sales_amount
     */ 
    public $subseller_sales_amount = 0;


    /**
     * @var float $subseller_id
     */ 
    public $subseller_id = 0;


    /**
     * @var array $order_items
     */ 
    public $order_items = [];


    /**
     * Setter for attribute $subseller_sales_amount
     * @param float $value
     * @return $this
     */
    public function setSubsellerSalesAmount($value)
    {
        $this->subseller_sales_amount = $value;
        return $this;
    }

    /**
     * Getter for attribute $subseller_sales_amount
     * @return  float
     */
    public function getSubsellerSalesAmount()
    {
        return $this->subseller_sales_amount;
    }

    /**
     * Setter for attribute $subseller_id
     * @param float $value
     * @return $this
     */
    public function setSubsellerId($value)
    {
        $this->subseller_id = $value;
        return $this;
    }

    /**
     * Getter for attribute $subseller_id
     * @return  float
     */
    public function getSubsellerId()
    {
        return $this->subseller_id;
    }

    /**
     * Setter for attribute $order_items
     * @param array $value
     * @return $this
     */
    public function setOrderItems($value)
    {
        $this->order_items = $value;
        return $this;
    }

    /**
     * Getter for attribute $order_items
     * @return  array
     */
    public function getOrderItems()
    {
        return $this->order_items;
    }

    /**
     * Add on attribute $order_items
     * @param  array $value
     * @return $this
     */
    public function addOrderItems($value) 
    {
        array_push($this->order_items, $value);
        return $this;
    }

}
