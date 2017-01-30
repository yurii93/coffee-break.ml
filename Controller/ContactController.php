<?php

namespace Controller;

use Common\Session;
use Model\MessageModel;


class ContactController extends BaseController
{
    protected $views = "Contact";

    /*
     * Forms a page with contact form
     */
    public function index()
    {
        if ($_POST) {

            if ($_POST['name'] && $_POST['email'] && $_POST['message']) {

                $messageModel = new MessageModel();

                $validateResult = $messageModel->validate($_POST);

                if ($validateResult === true) {

                    if ($messageModel->save($_POST)) {

                        Session::set('success','Ваше сообщение успешно отправлено');

                        header("Location: /contact");
                        die();

                    } else {

                        $this->data['warning'] = 'Произошла ошибка';
                    }

                } else {

                    $this->data['warning'] = $validateResult;
                }

            } else {

                $this->data['warning'] = 'Все поля должны быть заполнены';
            }

        }

        if(Session::has('success')) {

            $this->data['success'] = Session::get('success');
            Session::delete('success');
        }

        $this->render('contact');
    }
}