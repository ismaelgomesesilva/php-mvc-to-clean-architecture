<?php

require_once "Customer.php";
require_once "DAO.php";

class CustomerDAO extends DAO
{
    public function selectAll()
    {
        $sql = "SELECT * FROM customer ORDER BY id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $customers = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Customer', ['fullname', 'email', 'id']);

            return $customers;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function select($id)
    {
        $sql = "SELECT * FROM customer WHERE id = :id ORDER BY fullname";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $customers = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Customer', ['fullname', 'email', 'id']);

            return $customers;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function selectAllWithTransactions()
    {
        $sql = "SELECT DISTINCT c.* FROM customer AS c RIGHT JOIN transaction AS t ON c.id = t.customer_id ORDER BY fullname";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $customers = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Customer', ['fullname', 'email', 'id']);

            return $customers;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function selectTop10Customers()
    {
        $sql = "SELECT * FROM customer ORDER BY fullname";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $customers = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Customer', ['fullname', 'email', 'id']);

            return $customers;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function insert($customer)
    {
        $sql = "INSERT INTO customer (fullname, email) VALUES (:name, :email)";
        $stmt = $this->connection->prepare($sql);

        $customerName = $customer->getFullName();
        $customerEmail = $customer->getEmail();

        $stmt->bindParam(':name', $customerName);
        $stmt->bindParam(':email', $customerEmail);
        
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
            return false;
        }
    }

    public function update($customer)
    {
        $sql = "UPDATE customer SET fullname = :name, email = :email WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $customerId = $customer->getId();
        $customerName = $customer->getFullName();
        $customerEmail = $customer->getEmail();

        $stmt->bindParam(':id', $customerId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $customerName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $customerEmail, PDO::PARAM_STR);

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
        $sql = "DELETE FROM customer WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
}
