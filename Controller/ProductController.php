<?php

namespace Controller;

use Common\Session;
use Model\ProductModel;
use Model\CommentModel;
use Common\Pagination;

class ProductController extends BaseController
{
    protected $views = "Products";

    /*
     * Forms a page with all products from DB
     */
    public function all($page)
    {
        $this->refreshFilter();

        if (!$page) {

            $page = 1;

        } elseif (!is_numeric($page)) {

            return $this->render404();
        }

        if (Session::has('orderOk')) {

            $this->data['orderOk'] = Session::get('orderOk');
            Session::delete('orderOk');
        }

        if (Session::has('orderNo')) {

            $this->data['orderNo'] = Session::get('orderNo');
            Session::delete('orderNo');
        }

        $productModel = new ProductModel();

        $filterData = $productModel->getFilterData();

        $isFilterWork = false;

        foreach ($filterData as $field) {

            if ($field) {

                $isFilterWork = true;
            }
        }

        $this->data['isFilterWork'] = $isFilterWork;
        $this->data['filterData'] = $filterData;

        $products = $productModel->getAllProducts($page, PRODUCTS_ON_PAGE);
        $totalProducts = $productModel->getAmountAllProducts();

        if (!$products && $page > 1) {

            return $this->render404();
        }

        $this->data['products'] = $products;

        $this->data['pagination'] = new Pagination($totalProducts[0], $page, PRODUCTS_ON_PAGE);

        $this->render('products');
    }

    /*
     * Forms a page with one product by its id
     */
    public function show($id)
    {
        $productModel = new ProductModel();

        $product = $productModel->getById($id);

        if (!$product) {

            return $this->render404();
        }

        $commentModel = new CommentModel();

        if ($_POST) {

            if ($_POST['comment']) {

                $validateResults = $commentModel->validate($_POST['comment']);

                if ($validateResults === true) {

                    if ($commentModel->addComment($_POST)) {

                        header("Location: " . $_SERVER['REQUEST_URI']);
                        die();

                    } else {

                        $this->data['warning'] = 'Произошла ошибка, попытайтесь снова.';
                    }

                } else {

                    $this->data['warning'] = $validateResults;
                }

            } else {

                $this->data['warning'] = 'Поле сообщения должно быть заполнено';
            }
        }

        $this->data['comments'] = $commentModel->getComments($id);

        $this->data['product'] = $product;

        $this->render('product');
    }

    /*
     * Forms a page with filtered products
     */
    public function filter()
    {
        if (!$_POST) {

            header('Location: /product/all');
            die();
        }

        $productModel = new ProductModel();

        $filterData = $productModel->getFilterData();

        $this->data['filterData'] = $filterData;

        if ($_POST['price-from'] == 0) {

            Session::delete('from');

        } else {

            Session::set('from', $_POST['price-from']);
        }

        if ($_POST['price-to'] == $filterData['value'][1]) {

            Session::delete('to');

        } else {

            Session::set('to', $_POST['price-to']);
        }

        if (!isset($_POST['vendor'])) {

            $_POST['vendor'] = $filterData['vendors'];

            Session::delete('vendorChecked');

        } else {

            Session::set('vendorChecked', serialize($_POST['vendor']));
        }

        if (!isset($_POST['type'])) {

            $_POST['type'] = $filterData['types'];

            Session::delete('typeChecked');

        } else {

            Session::set('typeChecked', serialize($_POST['type']));
        }

        $products = $productModel->getProductsByFilter($_POST);

        $this->data['products'] = $products;

        $this->render('filter');
    }

    /*
     * Provides data reset of filter
     */
    public function refreshFilter()
    {
        // Delete session data that filter use
        Session::delete('vendorChecked');
        Session::delete('typeChecked');
        Session::delete('from');
        Session::delete('to');

        if (!preg_match('~/product/all~', $_SERVER['REQUEST_URI'])) {

            header("Location: /product/all");
            die();
        }
    }
}