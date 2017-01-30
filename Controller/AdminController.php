<?php

namespace Controller;

class AdminController extends BaseController
{
    protected $views = "Admin";

    /*
     * Forms home page of admin panel
     */
    public function index()
    {
        $this->isAdmin();

        $this->adminRender('index');
    }

}