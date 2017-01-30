<?php

namespace Model;

use Common\Convert;
use Common\FileCache;

class ProductModel extends BaseModel
{
    const PRODUCTS_NUMBER_ON_PAGE = 3;

    protected $table = 'coffee_products';

    protected $validations = array(
        'title' => array(
            'min' => 2,
            'max' => 50
        ),
        'vendor' => array(
            'min' => 2,
            'max' => 25,
        ),
        'type' => array(
            'min' => 2,
            'max' => 20,
        ),
        'description' => array(
            'min' => 5,
        )
    );

    /*
     * Return list of random products
     * than have status is new
     */
    public function getRandomNewProducts($amount)
    {
        $result = $this->db->query("SELECT *
                                FROM {$this->table}
                                WHERE `is_new`=1
                                ORDER BY rand()
                                LIMIT {$amount}
                               ");

        return $result;
    }

    /*
     * Return list of random products
     * than have discount
     */
    public function getRandomDiscountProducts($amount)
    {
        $result = $this->db->query("SELECT *
                                FROM {$this->table}
                                WHERE `discount`> 0
                                AND `discount` < 1
                                ORDER BY rand()
                                LIMIT {$amount}
                               ");

        return $result;
    }

    /*
     * Return special information
     * for filter form
     */
    public function getFilterData()
    {
        $vendors = $this->db->query("SELECT DISTINCT `vendor`
                                FROM {$this->table}");

        $data['vendors'] = $this->comfortArray($vendors);

        $types = $this->db->query("SELECT DISTINCT `type`
                                FROM {$this->table}");

        $data['types'] = $this->comfortArray($types);

        $max = $this->db->query("SELECT MIN(price) as min, MAX(price) as max
                                FROM {$this->table}");

        $data['value'] = $this->comfortArray($max);

        return $data;
    }

    /*
     * Return list of all products using pagination
     */
    public function getAllProducts($page = 1, $amountForPage = self::PRODUCTS_NUMBER_ON_PAGE)
    {
        $page = intval($page);

        $amountForPage = intval($amountForPage);

        $offset = ($page - 1) * $amountForPage;
        
        $fileCacheName = "product-{$page}";

        if($result = FileCache::readCache($fileCacheName)) {

            return $result;
        }

        $result = $this->db->query("SELECT * FROM {$this->table} LIMIT {$amountForPage} OFFSET {$offset}");

        if($result) {

            FileCache::createCache($fileCacheName, $result);
        }

        return $result;
    }

    /*
     * Return list of all products using
     * filter conditions
     */
    public function getProductsByFilter($data)
    {
        if(!$data) {

            return false;
        }

        $vendor = "'" . implode("','", $data['vendor']) . "'";
        $type = "'" . implode("','", $data['type']) . "'";
        $from = $data['price-from'];
        $to = $data['price-to'];

        $sql = "SELECT * FROM {$this->table}
                WHERE `vendor` IN ({$vendor})
                AND `type` IN ({$type})
                AND `price` BETWEEN {$from} AND {$to}";

        $result = $this->db->query($sql);

        return $result;
    }

    /*
     * Return rhe number of all products
     */
    public function getAmountAllProducts()
    {
        $result = $this->db->query("SELECT COUNT(*) FROM {$this->table}");

        $result = $this->comfortArray($result);

        return $result;
    }

    /*
     * Save product to the DB
     */
    public function addProduct($data)
    {
        $title = $this->db->escape($data['title']);
        $vendor = $this->db->escape($data['vendor']);
        $type = $this->db->escape($data['type']);
        $description = $this->db->escape($data['description']);
        $price = $data['price'];

        if ($data['discount'] == 0) {
            $discount = 1;
        } else {
            $discount = $data['discount'] / 100;
        }

        if (!isset($data['is_new'])) {
            $isNew = 0;
        } else {
            $isNew = $data['is_new'];
        }

        if (!isset($data['in_stock'])) {
            $inStock = 0;
        } else {
            $inStock = $data['in_stock'];
        }

        $title = htmlspecialchars($title);
        $vendor = htmlspecialchars($vendor);
        $type = htmlspecialchars($type);
        $description = htmlspecialchars($description);

        $result = $this->db->query("INSERT INTO {$this->table} 
                                    SET `title` = '{$title}',
                                    `vendor` = '{$vendor}',
                                    `type` = '{$type}',
                                    `description` = '{$description}',
                                    `price` = '{$price}',
                                    `discount` = '{$discount}',
                                    `is_new` = '{$isNew}',
                                    `in_stock` = '{$inStock}'");

        if ($result) {
            return $this->db->lastId();
        }
    }

    /*
     * Update product information in the DB
     */
    public function editProduct($data, $id)
    {
        $id = intval($id);

        $title = $this->db->escape($data['title']);
        $vendor = $this->db->escape($data['vendor']);
        $type = $this->db->escape($data['type']);
        $description = $this->db->escape($data['description']);
        $price = $data['price'];

        if ($data['discount'] == 0) {
            $discount = 1;
        } else {
            $discount = $data['discount'] / 100;
        }

        if (!isset($data['is_new'])) {
            $isNew = 0;
        } else {
            $isNew = $data['is_new'];
        }

        if (!isset($data['in_stock'])) {
            $inStock = 0;
        } else {
            $inStock = $data['in_stock'];
        }

        $title = htmlspecialchars($title);
        $vendor = htmlspecialchars($vendor);
        $type = htmlspecialchars($type);
        $description = htmlspecialchars($description);

        $result = $this->db->query("UPDATE {$this->table} 
                                    SET `title` = '{$title}',
                                    `vendor` = '{$vendor}',
                                    `type` = '{$type}',
                                    `description` = '{$description}',
                                    `price` = '{$price}',
                                    `discount` = '{$discount}',
                                    `is_new` = '{$isNew}',
                                    `in_stock` = '{$inStock}'
                                    WHERE `id` = '{$id}'");

        return $result;
    }

    /*
     * Return list of ordered products to the cart
     */
    public function getProductsByIds($ids)
    {
        $result = $this->db->query("select * from {$this->table} where id in ($ids)");

        return $result;
    }

    /*
     * Returns root to image file
     */
    public static function getImage($id)
    {
        $noImage = 'no-image.jpg';

        $path = '/webroot/uploads/';

        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists(SITE_DIR . $pathToProductImage)) {

            return $pathToProductImage;

        } else {

            return $path . $noImage;
        }
    }

    /*
     * Return products in XML or JSON format
     */
    public function getFormat($format)
    {
        $result = $this->getAll();

        if($format == 'xml') {

            $xml_data = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');

            Convert::to_xml($result, $xml_data);

            return $xml_data->asXML();

        } elseif ($format == 'json') {

            return json_encode($result, JSON_PRETTY_PRINT);
        }
    }
}