<?php

namespace Model;


class MessageModel extends BaseModel
{
    protected $table = 'coffee_messages';

    protected $validations = array(
        'name' => array(
            'min' => 2,
            'max' => 20
        ),
        'message' => array(
            'min' => 2,
            'max' => 200
        ),
        'email' => array(
            'pattern' => '/^[a-zA-Z0-9\-\_\.]+@[a-zA-Z0-9\-\_\.]+\.[a-z]{2,5}$/i'
        ),
    );

    /*
     * Save message to the DB
     */
    public function  save($data)
    {
        $name = ucfirst(mb_strtolower($this->db->escape($data['name'])));
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);

        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $message = htmlspecialchars($message);

        $query = "INSERT INTO {$this->table} 
                  SET `name` = '{$name}',
                  `email` = '{$email}',
                  `message` = '{$message}'";
        
        return $this->db->query($query);
    }

    /*
     * Returns a list of messages
     * (special for admin)
     */
    public function getMessagesForAdmin()
    {
        $result = $this->db->query("SELECT * FROM {$this->table} ORDER BY `date` DESC");

        return $result;
    }
}