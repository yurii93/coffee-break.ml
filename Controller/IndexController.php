<?php

namespace Controller;

use Model\MessageModel;
use Model\ProductModel;

class IndexController extends BaseController
{
    protected $views = "Index";

    /*
     * Forms a start page of the site
     */
    public function index() 
    {
        $productModel = new ProductModel();
        
        $this->data['newProducts'] = $productModel->getRandomNewProducts(10);
        $this->data['discountProducts'] = $productModel->getRandomDiscountProducts(10);
        
        $this->indexRender();
    }
}