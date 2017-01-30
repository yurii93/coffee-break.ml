<?php

namespace Controller;

use Common\Cart;
use Common\Session;
use Model\ProductModel;
use Model\UserModel;
use Model\OrderModel;
use Common\PHPMailer\PHPMailer;

class OrderController extends BaseController
{
    protected $views = "Order";

    /*
     * Forms a page with order form
     * and products from the cart
     */
    public function index()
    {
        $referer = null;

        if (isset($_SERVER['HTTP_REFERER'])) {

            $referer = $_SERVER['HTTP_REFERER'];
        }

        if (($referer !== 'http://www.coffee-break.ml/cart' && !Session::get('products')) || !Session::get('orderActive') && !Session::get('products')) {

            header("Location: /product/all");
            die();
        }

        Session::set('orderActive', 1);

        $this->data['orderList'] = Cart::getProducts();

        $productsIds = array_keys($this->data['orderList']);

        // Строка для sql-запроса
        $idsString = implode(',', $productsIds);

        $productModel = new ProductModel();

        if ($idsString) {

            $this->data['productsInfo'] = $productModel->getProductsByIds($idsString);

            // Получаем общую стоимость товаров
            $this->data['totalPrice'] = Cart::getTotalPrice($this->data['productsInfo']);

        } else {

            $this->data['productsInfo'] = array();
        }

        if (Session::get('login')) {

            $userModel = new UserModel();

            $user = $userModel->getUserByEmail(Session::get('login'));

            $this->data['userInfo'] = $user;
        }

        if ($_POST) {

            if ($_POST['name'] && $_POST['email'] && $_POST['surname'] && $_POST['tel'] && $_POST['city']) {

                $orderModel = new OrderModel();

                $validateResult = $orderModel->validate($_POST);

                if ($validateResult === true) {

                    $id = $orderModel->saveOrder($_POST, $this->data['orderList'], $this->data['totalPrice']);

                    $date = date("d-m-Y H:i:s");

                    if ($id) {
						
						$message = "<h2 style='color: red'>Пришел новый заказ. Зайди в админ панель!</h2>
                            <table border='1'>
                                <tr>
                                    <th>Номер заказа</th>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Email</th>
                                    <th>Телефон</th>
                                    <th>Сума</th>
                                    <th>Дата</th>
                                </tr>
                                <tr>
                                    <td>{$id}</td>
                                    <td>{$_POST['name']}</td>
                                    <td>{$_POST['surname']}</td>
                                    <td>{$_POST['email']}</td>
                                    <td>{$_POST['tel']}</td>
                                    <td>{$this->data['totalPrice']}</td>
                                    <td>{$date}</td>
                                </tr>
                            </table>";
						$to = "jeldak@meta.ua";
						$from = "info@coffee-break.ml";
						$subject = "Заказ №{$id}";
						$subject = "=?utf-8?B?".base64_encode($subject)."?=";
						$headers = "From: $from\r\nReply-to: $from\r\nContent-type:
						text/html; charset=utf-8\r\n";
						
                        mail($to, $subject, $message, $headers);

                        Session::delete('products');
                        Session::delete('orderActive');
                        Session::set('orderOk', 'Спасибо. Ваш заказ принят. В ближайшее время наш менеджер с Вами свяжется');

                        header("Location: /product/all");
                        die();

                    } else {

                        Session::set('orderNo', 'Произошла ошибка. Повторите заказ снова');

                        header("Location: /product/all");
                        die();
                    }

                } else {

                    $this->data['warning'] = $validateResult;
                }

            } else {

                $this->data['warning'] = 'Все поля со * должны быть заполнены';
            }

        }

        $this->data['noToOrder'] = true;

        $this->render('order');
    }
}