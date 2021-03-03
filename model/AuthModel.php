<?php


namespace app\model;



use app\core\Application;
use app\core\Database;

/**
 * Class AuthModel
 * @package app\model
 */
class AuthModel
{
    /**
     * @var Database
     */
    private Database $db;

    /**
     * AuthModel constructor.
     */
    public function __construct()
    {
        $this->db = Application::$app->db;
    }


    /**
     * check if the given email is in data base
     * @param $email
     * @return bool
     */
    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE `email` = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->singleRow();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Register to db
     * @param $data
     * @return bool
     */
    public function registerToDb($data)
    {
        $this->db->query("INSERT INTO users (`name`, `lastname`, `email`, `phone`, `address`, `password`) VALUES (:name, :lastname, :email, :phone, :address, :password)");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone'] || '');
        $this->db->bind(':address', $data['address']  || '');
        // hashed
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logins to db
     * @param $email
     * @param $notHashedPass
     * @return false|mixed
     */
    public function loginToDb($email, $notHashedPass)
    {
        $this->db->query("SELECT * FROM users WHERE `email` = :email");
        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        if ($row) {
            $hashedPassword = $row->password;
        } else {
            return false;
        }

        // check password
        if (password_verify($notHashedPass, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

}