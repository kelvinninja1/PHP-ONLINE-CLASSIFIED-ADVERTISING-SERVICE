<?php
namespace App\lib;
class DB
{
    protected $connection;
    private static $instance;
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;

    public static function getInstance()
    {
        if(self::$instance===null){
            self::$instance=new self;
        }
        return self::$instance;
    }
    private function __construct()
    {
        $this->host=Config::get('db.host');
        $this->user=Config::get('db.user');
        $this->password=Config::get('db.password');
        $this->db_name=Config::get('db.db_name');
        $this->connection = new \mysqli($this->host,  $this->user, $this->password, $this->db_name);
        $this->query('SET NAMES UTF8');

        if (mysqli_connect_error()) {
            throw new \Exception('Could not connect to DB');

        }
    }

    private function __clone(){}
    private function __sleep(){}

    private function __wakeup(){}

    public function query($sql)
    {
        if (!$this->connection) {
            return false;
        }

        $result = $this->connection->query($sql);

        if (mysqli_error($this->connection)) {
            throw new \Exception(mysqli_error($this->connection));
        }

        if (is_bool($result)) {
            return $result;
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function escape($str)
    {
        return mysqli_escape_string($this->connection, $str);
    }


    public function getAffectedRows($sql)
    {
        $result = $this->connection->query($sql);
//        echo "<pre>";
//        die(var_dump($this->query($sql)));
        if (is_object($result)) {
            return $result->num_rows;
        }
    }

    /**
     * @return mysqli
     */
    public function getConnection()
    {
        return $this->connection;
    }

}