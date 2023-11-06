<?php

namespace App\Libraries;

use PDO;
use Exception;
use PDOException;

class Database {
    public static function init(array $config = []) {
        return new QueryBuilder($config); 
    }
}

class QueryBuilder {

    protected $db;

    public function __construct($config = [])
    {  
        try {
            $username = $config['USERNAME'] ?? Config::get("DATABASE.USERNAME");
            $password = $config['PASSWORD'] ?? Config::get("DATABASE.PASSWORD");

            $this->db = new PDO(
                $this->buildConnectionString($config),
                $username,
                $password
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            Logger::error("Connection failed: " . $e->getMessage());
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    protected function buildConnectionString($config = [])
    {
        $driver   = $config["DRIVER"] ?? Config::get("DATABASE.DRIVER");
        $hostname = $config["HOST"] ?? Config::get("DATABASE.HOST");
        $port     = $config["PORT"] ?? Config::get("DATABASE.PORT");
        $database = $config["DATABASE"] ??Config::get("DATABASE.DATABASE");

        return "{$driver}:host={$hostname};port={$port};dbname={$database};charset=utf8mb4";
    }

    public function select($query, $parameters = [])
    {
        $statement = $this->db->prepare($query);
        $statement->execute($parameters);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        $stmt = $this->db->prepare($sql);

        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($table, $data, $where)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');

        $sql = "UPDATE $table SET $set WHERE $where";
        $stmt = $this->db->prepare($sql);

        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $this->db->prepare($sql);
        
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function __destruct()
    {
        $this->db = null; 
    }
}
