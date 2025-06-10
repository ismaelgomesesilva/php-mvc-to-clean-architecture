<?php

require_once "service/CustomerService.php";
require_once "model/CustomerDAO.php";
require_once "model/Customer.php";
require_once "view/View.php";

use Valitron\Validator;

class CustomerController
{
    private $data;
    private $customerService;

    public function __construct()
    {
        $this->data = array();
        $transactionDAO = new TransactionDAO();
        $this->customerService = new CustomerService($transactionDAO);
    }

    public function index()
    {
        $this->data = array();
        $custdao = new CustomerDAO();

        try {
            if(isset($_GET['filter'])){
                switch($_GET['filter']){
                    case 'all':
                    default:
                        $customers = $custdao->selectAll();
                        break;
                    case 'transaction_only':
                        $customers = $custdao->selectAllWithTransactions();
                        break;
                    case 'top10':
                        $customers = $custdao->selectTop10Customers();
                        break;
                }
            }else{
                $customers = $custdao->selectAll();
        }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->customerService->addTotalPurchaseAmountToCustomers($customers);

        $this->data['customers'] = $customers;
        

        View::load('view/template/header.html');
        View::load('view/customer/index.php', $this->data);
        View::load('view/template/footer.html');
    }

    private function filterCustomers($custdao){
        
    }

    

    public function show($id)
    {
        $this->data = array();
        $custdao = new CustomerDAO();

        try {
            $customers = $custdao->select($id);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['customers'] = $customers;

        View::load('view/template/header.html');
        View::load('view/customer/show.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function create()
    {
        View::load('view/template/header.html');
        View::load('view/customer/create.php');
        View::load('view/template/footer.html');
    }

    public function store($data)
    {
        try {
            $custdao = new CustomerDAO();
            $v = new Validator($data);
            $v->rule('required', ['name', 'email']);
            if ($v->validate()) {
                $newCustomer = new Customer();
                $newCustomer->setFullName($data['name']);
                $newCustomer->setEmail($data['email']);
                $custdao->insert($newCustomer);
                header('location: index.php?customer=index');
            } else {
                $this->data = [];
                $this->data['errors'] = $this->handleValidationErrors($v->errors());
                View::load('view/template/header.html');
                View::load('view/customer/create.php', $this->data);
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

        try {
            $customer = $custdao->select($id);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['customer'] = $customer;

        View::load('view/template/header.html');
        View::load('view/customer/edit.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function update($data)
    {
        try {
            $v = new Validator($data);
            $custdao = new CustomerDAO();
            $v->rule('required', ['name', 'email']);
            if ($v->validate()) {
                $customer = new Customer();
                $customer->setId($data['id']);
                $customer->setFullName($data['name']);
                $customer->setEmail($data['email']);
                $custdao->update($customer);
                header('location: index.php?customer=index');
            } else {
                $this->data = [];
                $this->data['errors'] = $this->handleValidationErrors($v->errors());
                View::load('view/template/header.html');
                View::load('view/customer/create.php', $this->data);
                View::load('view/template/footer.html');
            }
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $custdao = new CustomerDAO();
        try {
            $custdao->delete($id);
            header('location: index.php?customer=index');
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
