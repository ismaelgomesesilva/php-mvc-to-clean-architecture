<?php

require_once "model/TransactionDAO.php";
require_once "model/Transaction.php";
require_once "view/View.php";

use Valitron\Validator;

class TransactionController
{
    private $data;

    public function index()
    {
        $this->data = array();
        $transdao = new TransactionDAO();

        try {
            $transactions = $transdao->selectAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['transactions'] = $transactions;

        View::load('view/template/header.html');
        View::load('view/transaction/index.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function create()
    {
        $this->data = array();
        $custdao = new CustomerDAO();
        $this->data['customers'] = $custdao->selectAll();

        View::load('view/template/header.html');
        View::load('view/transaction/create.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function store($data)
    {
        $custdao = new CustomerDAO();
        $this->data['customers'] = $custdao->selectAll();
        try {
            $transdao = new TransactionDAO();
            $v = new Validator($data);
            $v->rule('required', ['amount', 'customer', 'datetime']);
            $v->rule('date', 'datetime');
            $v->rule('numeric', 'amount');
            if ($v->validate()) {
                $newTransaction = new Transaction();
                $newTransaction->setPurchaseAmount($data['amount']);
                $newTransaction->setCustomerId($data['customer']);
                $newTransaction->setTransactionDate($data['datetime']);
                $transdao->insert($newTransaction);

                header('location: index.php?transaction=index');
            } else {
                $this->data = [];
                $this->data['errors'] = $this->handleValidationErrors($v->errors());
                View::load('view/template/header.html');
                View::load('view/transaction/create.php', $this->data);
                View::load('view/template/footer.html');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function edit($id)
    {
        $this->data = array();
        $custdao = new CustomerDAO();
        $transdao = new TransactionDAO();

        try {
            $this->data['customers'] = $custdao->selectAll();
            $this->data['transaction'] = $transdao->select($id)[0];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        View::load('view/template/header.html');
        View::load('view/transaction/edit.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function update($data)
    {
        $custdao = new CustomerDAO();
        $this->data['customers'] = $custdao->selectAll();
        try {
            $v = new Validator($data);
            $transdao = new TransactionDAO();
            $v->rule('required', ['amount', 'customer', 'datetime', 'id']);
            $v->rule('date', 'datetime');
            $v->rule('numeric', 'amount');
            if ($v->validate()) {
                $transaction = new Transaction();
                $transaction->setId($data['id']);
                $transaction->setPurchaseAmount($data['amount']);
                $transaction->setCustomerId($data['customer']);
                $transaction->setTransactionDate($data['datetime']);
                $transdao->update($transaction);
                header('location: index.php?transaction=index');
            } else {
                $this->data = [];
                $this->data['errors'] = $this->handleValidationErrors($v->errors());
                View::load('view/template/header.html');
                View::load('view/transaction/create.php', $this->data);
                View::load('view/template/footer.html');
            }
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $transdao = new TransactionDAO();
        try {
            $transdao->delete($id);
            header('location: index.php?transaction=index');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function handleValidationErrors($errors)
    {
        $data = [];
        foreach ($errors as $errors) {
            foreach ($errors as $validation) {
                array_push($data, $validation);
            }
        }
        return $data;
    }
}
