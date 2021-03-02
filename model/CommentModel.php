<?php


namespace app\model;


use app\core\Application;
use app\core\Database;

class CommentModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }

    public function insertComment($data)
    {
        $this->db->query("INSERT INTO comments (`name`, `comment`) VALUES (:name, :comment)");

        // add values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':comment', $data['comment']);

        // make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getComments()
    {
        $this->db->query('SELECT * FROM comments ORDER BY created_at DESC ');

        $comments = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $comments;

        }
        return false;
    }
}