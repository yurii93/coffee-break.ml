<?php

namespace Model;

use Common\Functions;

class OrderModel extends BaseModel
{
    protected $table = 'coffee_orders';

    protected $validations = array(
        'email' => array(
            'pattern' => '/^[a-zA-Z0-9\-\_\.]+@[a-zA-Z0-9\-\_\.]+\.[a-z]{2,5}$/i'
        ),
        'name' => array(
            'min' => 2,
            'max' => 20
        ),
        'surname' => array(
            'min' => 2,
            'max' => 25,
        ),
        'tel' => array(
            'min' => 5,
            'max' => 12,
        ),
        'city' => array(
            'min' => 2,
            'max' => 30
        )
    );

    /*
     * Save order to the DB
     */
    public function saveOrder($customerInfo, $productInfo, $sum)
    {
        $products = json_encode($productInfo);

        $userId = $customerInfo['userId'];
        $name = Functions::ucfirst_utf8(mb_strtolower($this->db->escape($customerInfo['name'],'UTF-8')));
        $surname = Functions::ucfirst_utf8(mb_strtolower($this->db->escape($customerInfo['surname'],'UTF-8')));
        $email = $this->db->escape($customerInfo['email']);
        $tel = $this->db->escape($customerInfo['tel']);
        $city = Functions::ucfirst_utf8(mb_strtolower($this->db->escape($customerInfo['city'],'UTF-8')));

        if(isset($customerInfo['addres'])) {
            $addres = $this->db->escape($customerInfo['addres']);
        } else {
            $addres = NULL;
        }

        if(isset($customerInfo['message'])) {
            $message = $this->db->escape($customerInfo['message']);
        } else {
            $message = NULL;
        }

        $name = htmlspecialchars($name);
        $surname = htmlspecialchars($surname);
        $email = htmlspecialchars($email);
        $tel = htmlspecialchars($tel);
        $city = htmlspecialchars($city);
        $addres = htmlspecialchars($addres);
        $message = htmlspecialchars($message);

        $result = $this->db->query("INSERT INTO {$this->table} 
                                    SET `userId` = '{$userId}',
                                    `name` = '{$name}',
                                    `surname` = '{$surname}',
                                    `products` = '{$products}',
                                    `email` = '{$email}',
                                    `city` = '{$city}',
                                    `addres` = '{$addres}',
                                    `message` = '{$message}',
                                    `sum` = '{$sum}',
                                    `tel` = '{$tel}'");
        
        if($result) {

            return $this->db->lastId();
        }

        return false;
    }

    /*
     * Returns list of orders by user' id
     */
    public function ordersByUserId($id)
    {
        $id = intval($id);

        $result = $this->db->query('SELECT * FROM ' . $this->table . " WHERE `userId` = {$id} ORDER BY `date` DESC");

        return $result;
    }

    /*
     * Returns list of orders by status
     */
    public function getAllOrderByStatus($status)
    {
        $status = intval($status);

        $result = $this->db->query('SELECT * FROM ' . $this->table . " WHERE `status` = {$status} ORDER BY `date` DESC");

        return $result;
    }

    /*
     * Provides change order status
     */
    public function changeOrderStatus($id)
    {
        $id = intval($id);

        $result = $this->db->query("UPDATE {$this->table} SET `status` = 1 WHERE `id` = '{$id}';");

        return $result;
    }
}