<?php

require_once "Transaction.php";
require_once "DAO.php";

class TransactionDAO extends DAO
{
    public function selectAll()
    {
        $sql = "SELECT * FROM transaction ORDER BY id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $transactions = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Transaction', ['purchase_amount', 'transaction_date', 'customer_id', 'id']);

            return $transactions;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function select($id)
    {
        $sql = "SELECT * FROM transaction WHERE id = :id ORDER BY transaction_date";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $transactions = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Transaction', ['purchase_amount', 'transaction_date', 'customer_id', 'id']);

            return $transactions;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function insert($transaction)
    {
        $sql = "INSERT INTO transaction (purchase_amount, transaction_date, customer_id) VALUES (:purchase_amount, :transaction_date, :customer_id)";
        $stmt = $this->connection->prepare($sql);

        $transactionPurchaseAmount = $transaction->getPurchaseAmount();
        $transactionDate = date('Y-m-d h:i:s', strtotime($transaction->getTransactionDate()));
        $transactionCustomerId = $transaction->getCustomerId();
    
        $stmt->bindParam(':purchase_amount', $transactionPurchaseAmount);
        $stmt->bindParam(':transaction_date', $transactionDate);
        $stmt->bindParam(':customer_id', $transactionCustomerId);
        
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
            return false;
        }
    }

    public function update($transaction)
    {
        $sql = "UPDATE transaction SET purchase_amount = :purchase_amount, transaction_date = :transaction_date, customer_id = :customer_id WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $transactionId = $transaction->getId();
        $transactionPurchaseAmount = $transaction->getPurchaseAmount();
        $transactionDate = date('Y-m-d h:i:s', strtotime($transaction->getTransactionDate()));
        $transactionCustomerId = $transaction->getCustomerId();

        $stmt->bindParam(':id', $transactionId, PDO::PARAM_INT);
        $stmt->bindParam(':purchase_amount', $transactionPurchaseAmount, PDO::PARAM_STR);
        $stmt->bindParam(':transaction_date', $transactionDate, PDO::PARAM_STR);
        $stmt->bindParam(':customer_id', $transactionCustomerId, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM transaction WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    /**
     * Get total purchase amount by customer ID
     * 
     * @return array Associative array with customer_id as key and total_purchase_amount as value
     */
    public function getTotalPurshaseAmountByCustomerId(){
        $sql = "SELECT customer_id, SUM(purchase_amount) AS total_purchase_amount FROM transaction GROUP BY customer_id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = [];
            foreach ($rows as $row) {
                $result[$row['customer_id']] = $row['total_purchase_amount'];
            }
            return $result;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
}
