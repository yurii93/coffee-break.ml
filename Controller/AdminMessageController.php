<?php

namespace Controller;

use Common\Session;
use Model\MessageModel;

class AdminMessageController extends BaseController
{
    protected $views = "AdminMessage";

    /*
     * Forms page with all messages from users
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

        $messageModel = new MessageModel();

        $messages = $messageModel->getEntityByDate();
        $this->data['messages'] = $messages;

        $this->adminRender('index');
    }

    /*
     * Delete message from DB by its id
     */
    public function deleteMessage($id)
    {
        $this->isAdmin();

        $pattern = 'adminMessage';
        $this->isReferer($pattern);

        $messageModel = new MessageModel();

        if ($messageModel->deleteEntityById($id)) {
            
            Session::set('admin-success', 'Сообщение удалено');

            header("Location: /adminMessage");
            die();

        } else {

            Session::set('admin-warning', 'Произошла ошибка');

            header("Location: /adminMessage");
            die();
        }
    }
}