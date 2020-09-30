<?php
/**
 * Created by PhpStorm.
 * User: brunopaz
 * Date: 09/07/2018
 * Time: 20:16
 */

namespace Getnet\API;

use Getnet\API\ToStringJsonTrait;

/**
 * Class BaseResponse
 * @package Getnet\API
 */
class BaseResponse implements \JsonSerializable
{
    use ToStringJsonTrait;

    /** @var int HTTP_STATUS_CREATED */
    const HTTP_STATUS_CREATED = 201;

    /** @var int HTTP_STATUS_ACCEPTED */
    const HTTP_STATUS_ACCEPTED = 202;

    /** @var int HTTP_STATUS_PAYMENT_REQUIRED */
    const HTTP_STATUS_PAYMENT_REQUIRED = 402;

    /** @var int HTTP_STATUS_BAD_REQUEST */
    const HTTP_STATUS_BAD_REQUEST = 400;

    /** @var int HTTP_STATUS_INTERNAL_SERVER_ERROR */
    const HTTP_STATUS_INTERNAL_SERVER_ERROR = 500;

    /** @var int SPECIAL_RETURN_STATUS_PENDING */
    const SPECIAL_RETURN_STATUS_PENDING = 1;

    /** @var string STATUS_AUTHORIZED */
    const STATUS_AUTHORIZED = "AUTHORIZED";

    /** @var string STATUS_DENIED */
    const STATUS_DENIED = "DENIED";

    /** @var string STATUS_ERROR */
    const STATUS_ERROR = "ERROR";

    /** @var string STATUS_PENDING */
    const STATUS_PENDING = "PENDING";

    /** @var array STATUS_PENDING */
    const RETURN_STATUS_MAP = [
        self::HTTP_STATUS_CREATED => self::STATUS_AUTHORIZED,
        self::HTTP_STATUS_ACCEPTED => self::STATUS_AUTHORIZED,
        self::HTTP_STATUS_PAYMENT_REQUIRED => self::STATUS_DENIED,
        self::HTTP_STATUS_BAD_REQUEST => self::STATUS_ERROR,
        self::HTTP_STATUS_INTERNAL_SERVER_ERROR => self::STATUS_ERROR,
        self::SPECIAL_RETURN_STATUS_PENDING => self::STATUS_PENDING,
    ];

    /**
     * @var
     */
    public $payment_id;
    /**
     * @var
     */
    public $seller_id;
    /**
     * @var
     */
    public $amount;
    /**
     * @var
     */
    public $currency;
    /**
     * @var
     */
    public $order_id;
    /**
     * @var
     */
    public $status;
    /**
     * @var
     */
    public $received_at;
    /**
     * @var
     */
    public $error_message;
    /**
     * @var
     */
    public $description;
    /**
     * @var
     */
    public $description_detail;
    /**
     * @var
     */
    public $status_code;
    /**
     * @var
     */
    public $responseJSON;

    /**
     * @var
     */
    public $status_label;
    
    /**
     * @return mixed
     */

    public function getErrorMessage()
    {
        return $this->error_message;
    }

    /**
     * @param mixed $error_message
     * @return BaseResponse
     */
    public function setErrorMessage($error_message)
    {
        $this->error_message = $error_message;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param mixed $status_code
     * @return BaseResponse
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescriptionDetail()
    {
        return $this->description_detail;
    }

    /**
     * @param mixed $description_detail
     * @return BaseResponse
     */
    public function setDescriptionDetail($description_detail)
    {
        $this->description_detail = $description_detail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorDescription()
    {
        return $this->description . "\n";
    }

    /**
     * @param mixed $description
     * @return BaseResponse
     */
    public function setErrorDescription($description)
    {
        $this->description = $description;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * @param mixed $payment_id
     */
    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSellerId()
    {
        return $this->seller_id;
    }

    /**
     * @param mixed $seller_id
     */
    public function setSellerId($seller_id)
    {
        $this->seller_id = $seller_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param mixed $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->translateStatus();
    }

    /**
     * @return void
     */
    private function translateStatus()
    {

        if (isset($this->status_label)) {
            $this->status = $this->status_label;
        }

        if (isset($this->redirect_url)) {
            $this->status = self::STATUS_PENDING;
        }

        if (array_key_exists($this->status_code, self::RETURN_STATUS_MAP)) {
            $this->status = self::RETURN_STATUS_MAP[$this->status_code];
        }

        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceivedAt()
    {
        return $this->received_at;
    }

    /**
     * @param mixed $received_at
     */
    public function setReceivedAt($received_at)
    {
        $this->received_at = $received_at;
        return $this;
    }

    /**
     * @param $json
     * @return $this
     */
    public function mapperJson($json)
    {

        array_walk_recursive($json, function ($value, $key) {

            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        });

        $this->setResponseJSON($json);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponseJSON()
    {
        return $this->responseJSON;
    }

    /**
     * @param mixed $array
     */
    public function setResponseJSON($array)
    {
        $this->responseJSON = json_encode($array, JSON_PRETTY_PRINT);
        return $this;
    }
}
