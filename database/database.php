<?php

class Database
{
    private static $instance;
    private PDO $connection;

    private string $DB_USERNAME = 'test';
    private string $DB_PASSWORD = 'test';
    private string $DSN = "mysql:host=127.0.0.1;dbname=apartment_management_system";

    private function __construct() {
        try {
            $this->connection = new PDO($this->DSN, $this->DB_USERNAME, $this->DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Connection failed: " . $exception->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) self::$instance = new self();
        return self::$instance;
    }

    private function getConnection(): PDO
    {
        return $this->connection;
    }

    // Prevents cloning of the instance
    private function __clone() {
    }

    // Prevents un-serialization of the instance
    private function __wakeup() {
    }

    // ADMIN
    public function getAdminByEmailAndPassword(string $email, string $password): ?array
    {
        $user = null;
        $connection = $this->getConnection();
        $query = "SELECT * FROM admin WHERE email = ? AND password = ?";
        $statement = $connection->prepare($query);
        $statement->bindParam(1, $email);
        $statement->bindParam(2, $password);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $user = [
                'user_id' => $row['user_id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'contact' => $row['contact'],
                'password' => $row['password'],
                'added_date' => $row['added_date']
            ];
        }
        return $user;
    }
}

