<?php

namespace Controller;

use Common\Session;

class BaseController
{
    // Name of the directory with views
    protected $views = "Index";

    // Name of the layount
    protected $layout = 'default';

    // Data for views
    protected $data;

    /*
     * Provides formation of a error page
     * if some action doesn't exists
     */
    public function index()
    {
        $this->render404();
    }

    /*
     * Provides formation of a page
     * using default layout
     */
    protected function render($templateName)
    {
        $data = $this->data;

        ob_start();
        include SITE_DIR . DS . "View" . DS . $this->views . DS . $templateName . ".php";
        $content = ob_get_clean();

        include SITE_DIR . DS . "View" . DS . "Layout" . DS . $this->layout . ".php";
    }

    /*
     * Forms a page with an error
     */
    protected function render404()
    {
        $data = $this->data;

        $link = '/';

        $message = 'На главную';

        if(isset($_SERVER['HTTP_REFERER'])) {

            $link = $_SERVER['HTTP_REFERER'];

            $message = 'Назад';
        }

        ob_start();
        include SITE_DIR . DS  ."view" . DS . "404.php";
        $content = ob_get_clean();

        include SITE_DIR . DS  ."view" . DS . "Layout" . DS . $this->layout . ".php";
    }

    /*
     * Provides formation of a page
     * using index layout
     */
    protected function indexRender()
    {
        $data = $this->data;

        ob_start();
        include SITE_DIR . DS . "View" . DS . $this->views . DS . "index.php";
        $content = ob_get_clean();

        include SITE_DIR . DS . "View" . DS . "Layout" . DS . "index.php";
    }

    /*
     * Provides formation of a page
     * using admin layout
     */
    protected function adminRender($templateName)
    {
        $data = $this->data;

        ob_start();
        include SITE_DIR . DS . "View" . DS . $this->views . DS . $templateName . ".php";
        $content = ob_get_clean();

        include SITE_DIR . DS . "View" . DS . "Layout" . DS . "admin.php";
    }

    /*
     * Checks if the user has admin role
     */
    protected function isAdmin() 
    {
        if(Session::get('login') && Session::get('role') == 'admin') {

            return true;

        } else {

            header("Location: /user/login");
            die();
        }
    }

    /*
     * Checks if the user has user role
     */
    protected function isUser()
    {
        if(Session::get('login') && Session::get('role') == 'user') {

            return true;

        } else {

            header("Location: /user/login");
            die();
        }
    }

    /*
     * Checks if the admin came from
     * permitted page
     */
    protected function isReferer($pattern)
    {
        $referer = null;
		
        if (isset($_SERVER['HTTP_REFERER'])) {

            $referer = $_SERVER['HTTP_REFERER'];
        }

        if (strpos($referer, $pattern) === false) {

            header("Location: /admin");
            die();
        }

    }

    /*
     * Checks the right of access
     * to the admin panel or user cabinet
     */
    protected function userFormDisplay()
    {
        if (Session::has('login') && Session::get('role') == 'user') {

            header('Location: /cabinet');
            die();

        } elseif (Session::has('login') && Session::get('role') == 'admin') {

            header('Location: /admin');
            die();
        }
    }
}


