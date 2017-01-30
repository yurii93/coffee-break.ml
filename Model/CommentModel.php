<?php

namespace Model;


class CommentModel extends BaseModel
{
    protected $table = 'coffee_comments';

    protected $validations = array(
        'comment' => array(
            'min' => 2,
            'max' => 255
        ),
    );

    /*
     * Returns all comments by product id
     */
    public function getComments($productId)
    {
        $id = intval($productId);

        return $this->db->query("SELECT * FROM {$this->table} WHERE `productId` = {$id} ORDER BY `date` ASC");
    }

    /*
     * Add comment to the DB
     */
    public function  addComment($data)
    {
        $productId = $data['productId'];
        $author = $this->db->escape($data['author']);
        $comment = $this->db->escape($data['comment']);

        $author = htmlspecialchars($author);
        $comment = htmlspecialchars($comment);

        $sql = " INSERT INTO `{$this->table}`
                    SET `author` = '{$author}',
                        `productId` = '{$productId}',
                        `comment` = '{$comment}'";

        return $this->db->query($sql);
    }

    /*
     * Returns all coments order by date
     * (special for admin)
     */
    public function getCommentsForAdmin()
    {
        $result = $this->db->query("SELECT * FROM {$this->table} ORDER BY `date` DESC");

        return $result;
    }

    /*
     * Delete all comments by product id
     */
    public function deleteComments($id)
    {
        $result = $this->db->query("DELETE FROM {$this->table} WHERE `productId` = '{$id}'");

        return $result;
    }
    
}