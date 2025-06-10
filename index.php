<?php

require_once "controller/CategoryController.php";
require_once "controller/ProductController.php";
require_once "controller/CustomerController.php";
require_once "controller/TransactionController.php";
require_once "vendor/autoload.php";
ini_set('display_errors', 1);

if (isset($_GET['product'])) {
    $product = new ProductController();
    switch ($_GET['product']) {
        case 'index':
            $product->index();
            break;
        case 'show':
            $product->show($_GET['id']);
            break;
        case 'create':
            $product->create();
            break;
        case 'store':
            $product->store($_POST);
            break;
        case 'destroy':
            $product->destroy($_GET['id']);
            break;
        case 'edit':
            $product->edit($_GET['id']);
            break;
        case 'update':
            $product->update($_POST);
            break;
        default:
            http_response_code(404);
    }
} elseif (isset($_GET['category'])) {
    $cat = new CategoryController();
    switch ($_GET['category']) {
        case 'index':
            $cat->index();
            break;
        case 'show':
            $cat->show($_GET['id']);
            break;
        case 'create':
            $cat->create();
            break;
        case 'edit':
            $cat->edit($_GET['id']);
            break;
        case 'store':
            $cat->store($_POST);
            break;
        case 'update':
            $cat->update($_POST);
            break;
        case 'destroy':
            $cat->destroy($_GET['id']);
            break;
        default:
            http_response_code(404);
    }
} elseif (isset($_GET['customer'])) {
    $customer = new CustomerController();
    switch ($_GET['customer']) {
        case 'index':
            $customer->index();
            break;
        case 'create':
            $customer->create();
            break;
        case 'store':
            $customer->store($_POST);
            break;
        case 'edit':
            $customer->edit($_GET['id']);
            break;
        case 'update':
            $customer->update($_POST);
            break;
        case 'destroy':
            $customer->destroy($_GET['id']);
            break;
        default:
            http_response_code(404);
    }
} elseif (isset($_GET['transaction'])) {
    $transaction = new TransactionController();
    switch ($_GET['transaction']) {
        case 'index':
            $transaction->index();
            break;
        case 'create':
            $transaction->create();
            break;
        case 'store':
            $transaction->store($_POST);
            break;
        case 'edit':
            $transaction->edit($_GET['id']);
            break;
        case 'update':
            $transaction->update($_POST);
            break;
        case 'destroy':
            $transaction->destroy($_GET['id']);
            break;
        default:
            http_response_code(404);
    }
} else {
    $product = new ProductController();
    $product->index();
}
