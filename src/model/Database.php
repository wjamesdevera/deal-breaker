<?php

declare(strict_types=1);

namespace DealBreaker\Model;

require_once dirname(dirname(__DIR__)) ."\\config\\config.php";

use PDOException;
use PDO;

class Database
{
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $databaseName = DB_NAME;

    protected function connect()
    {
        try {
            $dbh = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->databaseName}", $this->username, $this->password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    protected static function sanitizeInput(string $data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
