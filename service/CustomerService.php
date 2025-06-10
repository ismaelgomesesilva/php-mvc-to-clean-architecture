<?php

class CustomerService {
    private $transactionDAO;

    public function __construct(TransactionDAO $transactionDAO) {
        $this->transactionDAO = $transactionDAO;
    }

    public function addTotalPurchaseAmountToCustomers(&$customers): void
    {
        if (empty($customers)) {
            return; // No customers to process
        }

        $totalPurchases = $this->transactionDAO->getTotalPurshaseAmountByCustomerId();
        
        foreach ($customers as $customer) {
            $amount = $totalPurchases[$customer->getId()] ?? 0;
            $customer->setTotalPurchaseAmount($amount);
        }
    }
}