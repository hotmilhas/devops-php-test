<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 10/10/18
 * Time: 11:13
 */

namespace App;

use App\database\MySQLConnector;
use Dotenv\Dotenv;
use PDO;

class Car
{
    private $mysql;

    /**
     * Car constructor.
     */
    public function __construct()
    {
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();
        $conn = new MySQLConnector(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_DATABASE'));
        $this->mysql = $conn;
    }


    public function save($car): bool
    {
        try {
            if (isset($car)) {
                $conn = $this->mysql->getConnection();
                $sql = "insert into cars (marca, modelo, fabricacao) values (?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $result = $stmt->execute([$car->marca, $car->modelo, $car->fabricacao]);
            }

            return $result ?? false;

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function all(): array
    {
        try {
            $conn = $this->mysql->getConnection();
            $sql = 'select * from cars';

            $stmt = $conn->query($sql);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function truncate() : bool
    {
        try {
            $conn = $this->mysql->getConnection();
            $sql = 'TRUNCATE TABLE cars';

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

}