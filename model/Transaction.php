<?php
require_once('Customer.php');
require_once('CustomerDAO.php');
class Transaction
{
    private $id;
    private $purchase_amount;
    private $transaction_date;
    private $customer_id;

    public function __construct($id = null, $purchase_amount = null, $transaction_date = null, $customer_id = null)
    {
        $this->id = $id;
        $this->purchase_amount = $purchase_amount;
        $this->transaction_date = $transaction_date;
        $this->customer_id = $customer_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPurchaseAmount()
    {
        return $this->purchase_amount;
    }

    public function setPurchaseAmount($purchase_amount)
    {
        $this->purchase_amount = $purchase_amount;
    }

    public function getTransactionDate()
    {
        return $this->transaction_date;
    }

    public function setTransactionDate($transaction_date)
    {
        $this->transaction_date = $transaction_date;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function getCustomer()
    {
        $customerDAO = new CustomerDAO();
        return $customerDAO->select($this->customer_id)[0];
    }

}