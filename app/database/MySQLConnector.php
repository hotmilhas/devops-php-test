<?php
namespace App\database;

use PDO;

class MySQLConnector
{
    private $pdo;
    private $dsn;
    private $user;
    private $pass;

    /**
     * MySQLConnector constructor.
     * @param $host
     * @param $user
     * @param $pass
     * @param $database
     */
    public function __construct($host, $user, $pass, $database)
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->dsn = sprintf('mysql:host=%s;dbname=%s', $host, $database);
        $this->connect();
    }

    public function connect()
    {
        if (!$this->isConnected()) {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
        }

    }

    public function isConnected()
    {
        return ($this->pdo instanceof PDO);
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}