<?php

class Sale {
    private $id;
    private $customerEmail;
    private $datetime;
    private $paymentMethod;
    private $total;
    private $paymentProcessed;
    private $productId;

    public function __construct($customerEmail, $paymentMethod, $total, $productId)
    {
        $this->setCustomerEmail($customerEmail);
        $this->setPaymentMethod($paymentMethod);
        $this->setTotal($total);
        $this->setProductId($productId);

        $this->setPaymentProcessed(false);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getPaymentProcessed()
    {
        return $this->paymentProcessed;
    }

    public function setPaymentProcessed($paymentProcessed)
    {
        $this->paymentProcessed = $paymentProcessed;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }
}

?>
