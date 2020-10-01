<?php

namespace Getnet\API;

class OrderItem implements \JsonSerializable
{
    use ToStringJsonTrait;

    /**
     * @var float $amount
     */ 
    public $amount = 0;


    /**
     * @var string $currency
     */ 
    public $currency = Transaction::DEFAULT_CURRENCY;


    /**
     * @var string $id
     */ 
    public $id = '';


    /**
     * @var string $description
     */ 
    public $description = '';


    /**
     * @var float $tax_percent
     */ 
    public $tax_percent = 0;


    /**
     * @var float $tax_amount
     */ 
    public $tax_amount = null;


    /**
     * Setter for attribute $amount
     * @param float $value
     * @return $this
     */
    public function setAmount($value)
    {
        $this->amount = $value;
        return $this;
    }

    /**
     * Getter for attribute $amount
     * @return  float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Setter for attribute $currency
     * @param string $value
     * @return $this
     */
    public function setCurrency($value)
    {
        $this->currency = $value;
        return $this;
    }

    /**
     * Getter for attribute $currency
     * @return  string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Setter for attribute $id
     * @param string $value
     * @return $this
     */
    public function setId($value)
    {
        $this->id = $value;
        return $this;
    }

    /**
     * Getter for attribute $id
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter for attribute $description
     * @param string $value
     * @return $this
     */
    public function setDescription($value)
    {
        $this->description = $value;
        return $this;
    }

    /**
     * Getter for attribute $description
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Setter for attribute $tax_percent
     * @param float $value
     * @return $this
     */
    public function setTaxPercent($value)
    {
        $this->tax_percent = $value;
        return $this;
    }

    /**
     * Getter for attribute $tax_percent
     * @return  float
     */
    public function getTaxPercent()
    {
        return $this->tax_percent;
    }

    /**
     * Setter for attribute $tax_amount
     * @param float $value
     * @return $this
     */
    public function setTaxAmount($value)
    {
        $this->tax_amount = $value;
        return $this;
    }

    /**
     * Getter for attribute $tax_amount
     * @return  float
     */
    public function getTaxAmount()
    {
        return $this->tax_amount;
    }

}
