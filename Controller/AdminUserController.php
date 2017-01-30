<?php

namespace Controller;

use Common\Session;
use Model\UserModel;

class AdminUserController extends BaseController
{
    protected $views = "AdminUser";

    /*
     * It forms a page with all users and information about them
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

        $userModel = new UserModel();

        $users = $userModel->usersForAdmin();

        $this->data['users'] = $users;

        $this->adminRender('index');
    }

    /*
     * Delete user from DB by its id
     */
    public function deleteUser($id)
    {
        $this->isAdmin();

        $pattern = 'adminUser';
        $this->isReferer($pattern);

        $userModel = new UserModel();

        if ($userModel->deleteEntityById($id)) {

            Session::set('admin-success', 'Пользователь удален');

            header("Location: $pattern");
            die();

        } else {

            Session::set('admin-warning', 'Произошла ошибка');

            header("Location: $pattern");
            die();
        }
    }
}