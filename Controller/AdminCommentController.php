<?php

namespace Controller;

use Common\Session;
use Model\CommentModel;
use Model\ProductModel;

class AdminCommentController extends BaseController
{
    protected $views = "AdminComment";

    /*
     * Forms page with all comments to the products
     */
    public function index()
    {
        $this->isAdmin();

        if (Session::get('admin-success')) {

            $this->data['success'] = Session::get('admin-success');
            Session::delete('admin-success');
        }

        if (Session::get('admin-warning')) {

            $this->data['warning'] = Session::get('admin-warning');
            Session::delete('admin-warning');
        }

        $userModel = new CommentModel();
        $productModel = new ProductModel();

        $comments = $userModel->getEntityByDate();
        $products = $productModel->getAll();

        $this->data['comments'] = $comments;
        $this->data['productsInfo'] = $products;

        $this->adminRender('index');
    }

    /*
     * Delete comment from DB by its id
     */
    public function deleteComment($id)
    {

        $this->isAdmin();

        $pattern = 'adminComment';
        $this->isReferer($pattern);


        $userModel = new CommentModel();

        if ($userModel->deleteEntityById($id)) {

            Session::set('admin-success', 'Отзыв удален');

            header("Location: /adminComment");
            die();

        } else {

            Session::set('admin-warning', 'Произошла ошибка');

            header("Location: /adminComment");
            die();
        }
    }
}