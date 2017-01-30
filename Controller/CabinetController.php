<?php

namespace Controller;


use Common\Session;

use Model\UserModel;

use Model\OrderModel;

use Model\ProductModel;


class CabinetController extends BaseController
{
    protected $views = "Cabinet";

    /*
     * Forms a start page of user cabinet
     */
    public function index()
    {
        $this->data['noCabinetOrAdmin'] = true;

        $this->isUser();

        $this->render('index');
    }

    /*
     * Forms a page with information about user
     */
    public function info()
    {
        $this->isUser();

        $this->data['noCabinetOrAdmin'] = true;

        $userModel = new UserModel();

        $userInfo = $userModel->getUserByEmail(Session::get('login'));

        $this->data['info'] = $userInfo;

        $this->render('info');
    }

    /*
     * Forms a page with form where user can change password
     */
    public function password()
    {
        $this->isUser();

        $this->data['noCabinetOrAdmin'] = true;

        if ($_POST) {

            if (!$_POST['old-password'] && !$_POST['new-password']) {

                $userModel = new UserModel();

                $validateResult = $userModel->validate($_POST);

                if ($validateResult === true) {

                    $checkPassword = $userModel->checkOldPassword($_POST['old-password']);

                    if ($checkPassword) {

                        if ($userModel->refreshPassword($_POST)) {

                            $this->data['success'] = 'Пароль успешно изменен';

                        } else {

                            $this->data['warning'] = 'Произошла ошибка';
                        }

                    } else {

                        $this->data['warning'] = 'Старый пароль введен не правильно';
                    }

                } else {

                    $this->data['warning'] = $validateResult;
                }

            } else {

                $this->data['warning'] = 'Все поля должны быть заполнены';
            }
        }

        $this->render('password');
    }

    /*
     * Forms a page with all user's orders
     */
    public function orders()
    {
        $this->isUser();

        $this->data['noCabinetOrAdmin'] = true;

        $orderModel = new OrderModel();

        $orders = $orderModel->ordersByUserId(Session::get('userId'));

        $this->data['ordersInfo'] = $orders;

        if ($orders) {

            $productArrays = array();

            foreach ($orders as $order) {

                $productArrays[$order['id']] = json_decode($order['products'], true);
            }

            $this->data['idsAndAmountsByOrder'] = $productArrays;

            foreach ($productArrays as $product) {

                foreach ($product as $productId => $amount) {

                    $productIdAndAmount[$productId] = $amount;
                }
            }

            $dataForIdsString = array_keys($productIdAndAmount);

            $idsString = implode(', ', $dataForIdsString);

            if ($idsString) {

                $productModel = new ProductModel();

                $productsInfo = $productModel->getProductsByIds($idsString);

                $this->data['productsInfo'] = $productsInfo;
            }

        }
        
        $this->render('orders');
    }
}