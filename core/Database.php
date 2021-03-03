<?php


namespace app\core;


/**
 * Class Database
 * @package app\core
 */
class Database
{
    /**
     * @var \PDO
     */
    private $dbh;
    /**
     * database handler
     * @var
     */
    private $stmt;
    /**
     * @var string
     */
    private $error;

    /**
     * Database constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];

        // set some connection options
        $options = [
            //sleshiukas t.b.
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];

        // create \PDO instance
        try {
            $this->dbh = new \PDO($dsn, $user, $password, $options);
        } catch (\PDOException $e) {
            // we catch error here
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * Prepare statments with query
     * @param $sql
     */
    public function query($sql)
    {
        // prepare sql statment and save it in local private var
        $this->stmt = $this->dbh->prepare($sql);
    }


    /**
     * Binds params to make them safer
     * @param $param
     * @param $value
     * @param null $type
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            // check what type is $value
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }


    /**
     * execute prepared and binded stament
     * return result
     * @return mixed
     */
    public function execute()
    {
        return $this->stmt->execute();
    }


    /**
     * Get results as an array
     * Return db result array
     * @return mixed
     */
    public function resultSet()
    {
        $this->execute();
        // \PDO::FETCH_OBJ $result[1]->id
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }


    /**
     * method to return single row of data
     * @return mixed
     */
    public function singleRow()
    {
        $this->execute();
        // \PDO::FETCH_OBJ $result->id
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }


    /**
     * method to get back number of rows
     * @return mixed
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

}