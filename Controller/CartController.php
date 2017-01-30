<?php

namespace Controller;


use Common\Cart;
use Common\Session;
use Model\OrderModel;
use Model\ProductModel;

class CartController extends BaseController
{
    protected $views = "Cart";

    /*
     * Adding products to the cart using AJAX
     */
    public function addAjax($ajaxData)
    {
        $data = explode('-',$ajaxData);

        echo Cart::addProduct($data);

        return true;
    }

    /*
     * Output added products to the cart
     */
    public function index()
    {
        if($_POST) {

            $emptyInput = true;

            foreach ($_POST['products'] as $amount) {

                if(!$amount) {

                    $emptyInput = false;
                }

            }

            if(!$emptyInput) {

                $this->data['warning'] = "Все поля c количеством товаров должны быть заполнены";

            } else {

                Session::set('products',$_POST['products']);

                header("Location: /cart");
                die();
            }

        }

        // Для перестраховки очищаем массив
        $this->data['orderList'] = false;

        // Получим данные из корзины
        $this->data['orderList'] = Cart::getProducts();

        // Проверяем есть ли в массиве товары (не пустой ли)
        if ($this->data['orderList']) {

            $productsIds = array_keys($this->data['orderList']);

            // Строка для sql-запроса
            $idsString = implode(',', $productsIds);
            
            $productModel = new ProductModel();

            // Если строка сформирована, получаем полную информацию о товарах с модели
            if($idsString) {

                $this->data['productsInfo'] = $productModel->getProductsByIds($idsString);
                
                // Получаем общую стоимость товаров
                $this->data['totalPrice'] = Cart::getTotalPrice($this->data['productsInfo']);

            } else {

                $this->data['productsInfo'] = array();
            }

        } else {

            $this->data['productsInfo'] = array();
        }

        $this->render('cart');
    }

    /*
     * Delete all products from the cart
     */
    public function delete() 
    {
        Session::delete('products');
        Session::delete('orderActive');

        header("Location: /cart");
        die();
    }

    /*
     * Delete one group of products from the cart
     */
    public function clear($id) 
    {
        if(count($_SESSION['products']) == 1) {

            unset($_SESSION['products'][$id]);

            $this->delete();

        } else {

            unset($_SESSION['products'][$id]);
        }

        header("Location: /cart/");
        die();
    }
}
