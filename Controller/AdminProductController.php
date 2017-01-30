<?php

namespace Controller;

use Common\Session;
use Model\ProductModel;
use Model\CommentModel;
use Common\FileCache;

class AdminProductController extends BaseController
{
    protected $views = "AdminProduct";

    /*
     * Show page with all products in DB
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

        $productModel = new ProductModel();

        $products = $productModel->getEntityByDate();

        $this->data['productsInfo'] = $products;

        $this->adminRender('index');
    }

    /*
     * Delete product from DB by its id
     */
    public function deleteProduct($id)
    {
        $this->isAdmin();

        $pattern = 'adminProduct';
        $this->isReferer($pattern);

        $messageModel = new ProductModel();

        if ($messageModel->deleteEntityById($id)) {

            $commentModel = new CommentModel();

            $commentModel->deleteComments($id);

            FileCache::deleteCache(CACHE_DIRECTORY);

            if (file_exists(SITE_DIR . "/webroot/uploads/{$id}.jpg")) {

                unlink(SITE_DIR . "/webroot/uploads/{$id}.jpg");

            }

            Session::set('admin-success', 'Товар удален');

            header("Location: $pattern");
            die();

        } else {

            Session::set('admin-warning', 'Произошла ошибка');

            header("Location: $pattern");
            die();
        }
    }

    /*
     * Add product to the DB
     */
    public function addProduct()
    {
        $this->isAdmin();

        if ($_POST) {

            if ($_POST['title'] && $_POST['vendor'] && $_POST['type'] && $_POST['price'] && $_POST['description']) {

                $productModel = new ProductModel();

                $validateResult = $productModel->validate($_POST);

                if ($validateResult === true) {

                    $id = $productModel->addProduct($_POST);

                    if ($id) {

                        FileCache::deleteCache(CACHE_DIRECTORY);

                        if ($this->uploadImage($_FILES['image'], $id)) {

                            Session::set('admin-success', 'Товар добавлен c изображением');

                        } else {

                            Session::set('admin-success', 'Товар добавлен без изображения');
                        }

                        header("Location: /adminProduct");
                        die();

                    } else {

                        Session::set('admin-warning', 'Произошла ошибка');

                        header("Location: /adminProduct");
                        die();
                    }

                } else {

                    $this->data['warning'] = $validateResult;
                }

            } else {

                $this->data['warning'] = 'Все поля со * должны быть заполнены';
            }
        }

        $this->adminRender('add');
    }

    /*
     * Edit the product in the DB by its id
     */
    public function editProduct($id)
    {
        $this->isAdmin();

        $productModel = new ProductModel();

        $pattern = 'adminProduct';
        $this->isReferer($pattern);

        if ($_POST) {

            if ($_POST['title'] && $_POST['vendor'] && $_POST['type'] && $_POST['price'] && $_POST['description']) {

                $validateResult = $productModel->validate($_POST);

                if ($validateResult === true) {

                    if ($productModel->editProduct($_POST, $id)) {

                        FileCache::deleteCache(CACHE_DIRECTORY);

                        if ($this->uploadImage($_FILES['image'], $id)) {

                            Session::set('admin-success', 'Товар отредактирован c изменением изображения');

                        } else {

                            Session::set('admin-success', 'Товар отредактирован без изменения изображения');
                        }

                        header("Location: /adminProduct");
                        die();

                    } else {

                        Session::set('admin-warning', 'Произошла ошибка');

                        header("Location: /adminProduct");
                        die();
                    }

                } else {

                    $this->data['warning'] = $validateResult;
                }

            } else {

                $this->data['warning'] = 'Все поля со * должны быть заполнены';
            }
        }

        $this->data['productInfo'] = $productModel->getById($id);

        $this->adminRender('edit');
    }

    /*
     * Shows products in XML or JSON format
     */
    public function displayFormat($format)
    {
        $this->isAdmin();

        $productModel = new ProductModel();

        if ($format == 'xml' || $format == '') {

            $result = $productModel->getFormat($format);

            header("Content-Type: text/xml");

            echo $result;

        } elseif ($format == 'json') {

            $result = $productModel->getFormat($format);

            header('Content-Type: application/json');

            echo $result;

        } else {

            return $this->render404();
        }
    }

    /*
     * Upload images to a server
     */
    private function uploadImage($image, $id)
    {
		if (file_exists(SITE_DIR . "/webroot/uploads/{$id}.jpg")) {

                unlink(SITE_DIR . "/webroot/uploads/{$id}.jpg");
		}
		
        if (is_uploaded_file($image['tmp_name'])) {

            $allowedTypes = array(
                'image/jpeg'
            );

            $id = (int)$id;

            if (in_array($image['type'], $allowedTypes)) {

                /* moving image */
                if (move_uploaded_file($image['tmp_name'], SITE_DIR . "/webroot/uploads/{$id}.jpg")) {

                    $width = 285;
                    $height = 480;
                    $image_p = imagecreatetruecolor($width, $height);
                    $image = imagecreatefromjpeg(SITE_DIR . "/webroot/uploads/{$id}.jpg");
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
                    imagejpeg($image_p, SITE_DIR . "/webroot/uploads/{$id}.jpg", 100);
                    imagedestroy($image_p);
                    imagedestroy($image);

                    return true;
                }
            }

            return false;
        }

        return false;
    }
}