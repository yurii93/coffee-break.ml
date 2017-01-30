<?php

namespace Common;

class Cart
{
    /*
     * Add product to the cart (session)
     */
    public static function addProduct($data)
    {
        $id = intval($data[0]);

        $amount = intval($data[1]);

        // Пустой массив для товаров в корзине
        $productsInCart = array();

        // Если в корзине уже есть товары (они хранятся в сессии)
        if (Session::has('products')) {
            // То заполним наш массив товарами
            $productsInCart = Session::get('products');
        }

        // Если товар есть в корзине, но был добавлен еще раз, увеличим количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] = $productsInCart[$id] + $amount;

        } else {
            // Добавляем новый товар в корзину
            $productsInCart[$id] = $amount;
        }
        
        Session::set('products',$productsInCart);

        return self::countItems();
    }

    /*
     * Count the number of products in cart
     */
    public static function countItems()
    {
        if (Session::has('products')) {

            $count = 0;

            foreach (Session::get('products') as $id => $quantity) {
                $count = $count + $quantity;
            }
            
            return $count;

        } else {

            return 0;
        }
    }

    /*
     * Returns all products from cart
     */
    public static function getProducts()
    {
        if(Session::has('products')) {

            return Session::get('products');
        }

        return false;
    }

    /*
     * Returns total price of all products in the cart
     */
    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();

        $total = 0;

        if($productsInCart) {

            foreach($products as $item) {

                $total += ($item['price'] - ($item['price'] * $item['discount'])) * $productsInCart[$item['id']];
            }
        }

        return $total;
    }
}
