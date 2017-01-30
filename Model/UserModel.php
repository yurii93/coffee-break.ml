<?php

namespace Model;

use Common\Session;
use Common\Functions;

class UserModel extends BaseModel
{
    protected $table = 'coffee_users';

    protected $validations = array(

        'password' => array(
            'min' => 6,
            'max' => 30
        ),
        'name' => array(
            'min' => 2,
            'max' => 20
        ),
        'surname' => array(
            'min' => 2,
            'max' => 25,
        ),
        'tel' => array(
            'min' => 5,
            'max' => 12,
        ),
        'email' => array(
            'pattern' => '/^[a-zA-Z0-9\-\_\.]+@[a-zA-Z0-9\-\_\.]+\.[a-z]{2,5}$/i'
        ),
        'old-password' => array(
            'min' => 6,
            'max' => 30
        ),
        'new-password' => array(
            'min' => 6,
            'max' => 30
        ),

    );

    /*
     * Return user by e-mail
     */
    public function getUserByEmail($email)
    {
        $email = $this->db->escape($email);

        $sql = "SELECT * FROM {$this->table} users WHERE email = '{$email}' LIMIT 1";

        $result = $this->db->query($sql);

        if (isset($result[0])) {

            return $result[0];
        }

        return false;
    }

    /*
     * Save user to the DB
     */
    public function saveUser($data)
    {
        $email = $this->db->escape($data['email']);
        $password = SALT . $this->db->escape($data['password']);
        $name = Functions::ucfirst_utf8(mb_strtolower($this->db->escape($data['name'],'UTF-8')));
        $surname = Functions::ucfirst_utf8(mb_strtolower($this->db->escape($data['surname'],'UTF-8')));
        $tel = $this->db->escape($data['tel']);

        if (!empty($data['city'])) {
            $city = Functions::ucfirst_utf8(mb_strtolower($this->db->escape($data['surname'],'UTF-8')));
            $city = htmlspecialchars($city);

        } else {
            $city = 'Неизвестно';
        }

        $email = htmlspecialchars($email);
        $name = htmlspecialchars($name);
        $surname = htmlspecialchars($surname);
        $tel = htmlspecialchars($tel);
        $password = htmlspecialchars($password);

        $sql = "INSERT INTO {$this->table} SET `email` = '{$email}',
                                      `password` = md5('{$password}'),
                                      `name` = '{$name}',
                                      `surname` = '{$surname}',
                                      `tel` = '{$tel}',
                                      `city` = '{$city}'";

        return $result = $this->db->query($sql);
    }

    /*
     * Checking uniqueness email
     */
    public function checkUserEmail($email)
    {
        $email = $this->db->escape($email);

        $result = $this->db->query("SELECT `email` FROM {$this->table} WHERE `email`='{$email}'");

        if($result) {

            return false;
        }

        return true;
    }

    /*
     * Checks if the old password is correct
     */
    public function checkOldPassword($oldPassword)
    {
        $oldPassword = $this->db->escape($oldPassword);

        $hash = md5(SALT . $oldPassword);
        
        $email = Session::get('login');

        $result = $this->db->query("SELECT `password` FROM {$this->table} WHERE `password`='{$hash}' AND `email`='{$email}' LIMIT 1");

        if(isset($result[0]) && $result[0]) {

            return true;

        } else {

            return false;
        }
    }

    /*
     * Provides update of the password
     */
    public function refreshPassword($passwords)
    {
        $oldPassword = $this->db->escape($passwords['old-password']);
        $oldPassword = htmlspecialchars($oldPassword);

        $hash = md5(SALT . $oldPassword);

        $newPassword = SALT . $this->db->escape($passwords['new-password']);
        $newPassword = htmlspecialchars($newPassword);

        $result = $this->db->query("UPDATE {$this->table} SET `password` = md5('{$newPassword}') WHERE `password` = '{$hash}';");

        return $result;
    }

    /*
     * Returns list of users order by date
     * (special for admin)
     */
    public function usersForAdmin()
    {
        $result = $this->db->query("SELECT * FROM {$this->table} WHERE `role` != 'admin' ORDER BY `date`");

        return $result;
    }
}