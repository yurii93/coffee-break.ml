<?php

namespace Controller;


use Common\Session;
use Model\UserModel;

class UserController extends BaseController
{
    protected $views = "User";

    /*
     * Forms a page with login form
     */
    public function login()
    {
        $this->userFormDisplay();

        if (Session::has('greeting')) {

            $this->data['success'] = Session::get('greeting');
            Session::delete('greeting');
        }

        if ($_POST) {

            if ($_POST['email'] && $_POST['password']) {

                $userModel = new UserModel();

                $validateResult = $userModel->emailValidate($_POST['email']);

                if ($validateResult === true) {

                    $user = $userModel->getUserByEmail($_POST['email']);

                    $hash = md5(SALT . $_POST['password']);

                    if ($user && $hash == $user['password']) {

                        Session::set('login', $user['email']);
                        Session::set('name', $user['name']);
                        Session::set('userId', $user['id']);
                        Session::set('role', $user['role']);

                        if ($user['role'] == 'admin') {

                            header('Location: /admin/');
                            die();

                        } else {

                            header('Location: /cabinet/');
                            die();
                        }

                    } else {

                        $this->data['warning'] = 'Неверные данные';
                    }

                } else {

                    $this->data['warning'] = $validateResult;
                }

            } else {

                $this->data['warning'] = 'Все поля должны быть заполнены';
            }

        }

        $this->data['noToOrder'] = true;

        $this->render('login');
    }

    /*
     * Forms a page with register form
     */
    public function register()
    {
        $this->userFormDisplay();

        if ($_POST) {

            if ($_POST['email'] && $_POST['password'] && $_POST['name'] && $_POST['surname'] && $_POST['tel']) {

                $userModel = new UserModel();

                $validateResult = $userModel->validate($_POST);

                if ($validateResult === true) {

                    $checkEmail = $userModel->checkUserEmail($_POST['email']);

                    if ($checkEmail == true) {

                        $registerUser = $userModel->saveUser($_POST);

                        if ($registerUser == true) {

                            Session::set('greeting', 'Поздравляем Вас! Вы успешно зарегистрировались.');

                            header('Location: /user');
                            die();

                        } else {

                            $this->data['warning'] = "Произошла ошибка";
                        }

                    } else {

                        $this->data['warning'] = "Пользователь с таким email уже существует";
                    }

                } else {

                    $this->data['warning'] = $validateResult;
                }

            } else {

                $this->data['warning'] = 'Поля со * должны быть обязательно заполнены';
            }

        }

        $this->data['noToOrder'] = true;

        $this->render('register');
    }

    /*
     * Provides exit from the cabinet or admin panel
     */
    public function logout()
    {
        Session::delete('login');
        Session::delete('name');
        Session::delete('role');
        Session::destroy();

        header('Location: /');
        die();
    }
}