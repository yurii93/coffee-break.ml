<?php
/**
 * Created by PhpStorm.
 * User: Yurii
 * Date: 29.10.2016
 * Time: 13:30
 */

namespace Controller;

use Model\BaseModel;
use Model\PageModel;

class PageController extends BaseController
{
    protected $views = "Pages";

    /*
     * Forms a static pages
     */
    public function show($alias)
    {
        if($alias === 'delivery') {

            $renderPage = $alias;

        } elseif ($alias === 'about') {

            $renderPage = $alias;
            
        } else {

            return $this->render404();
        }

        $this->render($renderPage);
    }
}