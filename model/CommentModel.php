<?php


namespace app\model;


use app\core\Application;
use app\core\Database;

/**
 * Class CommentModel
 * @package app\model
 */
class CommentModel
{
    /**
     * @var Database
     */
    private Database $db;

    /**
     * CommentModel constructor.
     */
    public function __construct()
    {
        $this->db = Application::$app->db;
    }

    /**
     * Inserts comments to db
     * @param $data
     * @return bool
     */
    public function insertComment($data)
    {
        $this->db->query("INSERT INTO comments (`name`, `comment`) VALUES (:name, :comment)");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':comment', $data['comment']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get comments from db
     * @return false|mixed
     */
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