<?php

namespace Model;


use Common\DB;
use Common\DbCache;

class BaseModel
{
    // database connection object
    protected $db;

    // name of table in DB used by model
    protected $table;

    // rules of validation
    protected $validations = array();

    public function __construct()
    {
        $this->db = new DB();
    }

    /*
     * Returns all items from DB
     */
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM {$this->table}");

        return $result;
    }

    /*
     * Returns all items from DB order by date
     */
    public function getEntityByDate()
    {
        $result = $this->db->query("SELECT * FROM {$this->table} ORDER BY `date` DESC");

        return $result;
    }

    /*
     * Returns item by its id
     */
    public function getById($id)
    {
        $id = intval($id);

        $result = $this->db->query('SELECT * FROM ' . $this->table . " WHERE id = {$id}");

        if (!$result) {

            return array();
        }

        return $result[0];
    }

    /*
     * Delete item by its id
     */
    public function deleteEntityById($id)
    {
        $result = $this->db->query("DELETE FROM {$this->table} WHERE `id` = '{$id}';");

        return $result;
    }

    /*
     * Returns a comfort representation oa array
     */
    public function comfortArray(array $startArray)
    {
        if(!$startArray) {

            return false;
        }

        foreach ($startArray as $item) {

            foreach ($item as $value) {

                $array[] = $value;
            }
        }

        $newArray = array_diff($array, array(''));

        return $newArray;
    }

    /*
     * Provides validation of the forms using rules
     */
    public function validate($array)
    {
        foreach ($this->validations as $field => $rules) {

            foreach ($rules as $rule => $value) {

                switch ($rule) {

                    case 'min':
                        if (isset($array[$field]) && iconv_strlen($array[$field]) < $value) {

                            return "Поле {$field} должно быть от {$value} символов";

                        } elseif(count($array) == 1) {

                            if (isset($array) && iconv_strlen($array) < $value) {

                                return "Поле {$field} должно быть от {$value} символов";
                            }
                        }
                        break;

                    case 'max':
                        if (isset($array[$field]) && iconv_strlen($array[$field]) > $value) {

                            return "Поле {$field} должно быть до {$value} символов";

                        } elseif(count($array) == 1) {

                            if (isset($array) && iconv_strlen($array) > $value) {

                                return "Поле {$field} должно быть до {$value} символов";
                            }
                        }
                        break;

                    case 'pattern':
                        if (isset($array[$field]) && !preg_match($value, $array[$field])) {

                            return "Поле {$field} должено быть коректно заполнено";
                        }
                        break;
                }
            }
        }

        return true;
    }

    /*
     * Provides e-mail validation in special case
     */
    public function emailValidate($email)
    {
        if (!preg_match('/^[a-zA-Z0-9\-\_\.]+@[a-zA-Z0-9\-\_\.]+\.[a-z]{2,5}$/i', $email)) {

            return "Поле email должено быть коректно заполнено";

        } else {

            return true;
        }
    }
}