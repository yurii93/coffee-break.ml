<?php

namespace Controller;

use Common\Session;
use Model\OrderModel;
use Model\ProductModel;

class AdminOrderController extends BaseController
{
    protected $views = "AdminOrder";

    /*
     * Forms page with all orders depending by status
     */
    public function index()
    {
        $type = func_get_arg(0);
		
        $this->isAdmin();
		
        if ($type !== 'finished' && $type !== 'unfinished') {

            header("Location: /admin");
            die();
        }
		
        if (Session::get('admin-success')) {

            $this->data['success'] = Session::get('admin-success');
            Session::delete('admin-success');
        }

        if (Session::get('admin-warning')) {

            $this->data['warning'] = Session::get('admin-warning');
            Session::delete('admin-warning');
        }

        $orderModel = new OrderModel();

        if ($type === 'finished') {

            $orders = $orderModel->getAllOrderByStatus(1);

        } elseif ($type === 'unfinished') {

            $orders = $orderModel->getAllOrderByStatus(0);
        }

        $this->data['ordersType'] = $type;
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

        $this->adminRender('index');
    }

    /*
     * Delete order from DB by its id
     */
    public function deleteOrder($id)
    {
        $this->isAdmin();

        $referer = null;

        if (isset($_SERVER['HTTP_REFERER'])) {

            $referer = $_SERVER['HTTP_REFERER'];
        }

        if ($referer === 'adminOrder/index/finished' || $referer === 'adminOrder/index/unfinished') {

            header("Location: /admin");
            die();
        }

        $messageModel = new OrderModel();

        if ($messageModel->deleteEntityById($id)) {

            Session::set('admin-success', 'Заказ удален');

            header("Location: $referer");
            die();

        } else {

            Session::set('admin-warning', 'Произошла ошибка');

            header("Location: $referer");
            die();
        }
    }

    /*
     * Change order status in DB by its id
     */
    public function changeOrderStatus($id)
    {
        $this->isAdmin();

        $pattern = 'adminOrder/index/unfinished';
        $this->isReferer($pattern);

        $messageModel = new OrderModel();

        if ($messageModel->changeOrderStatus($id)) {

            Session::set('admin-success', 'Заказ обработан');

            header("Location: $pattern");
            die();

        } else {

            Session::set('admin-warning', 'Произошла ошибка');

            header("Location: $pattern");
            die();
        }
    }
}