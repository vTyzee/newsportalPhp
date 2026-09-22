<?php

class Database
{
    private $conn;
    private $host;
    private $user;
    private $password;
    private $baseName;

    function __construct()
    {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->baseName = 'newsportal';

        $this->connect();
    }

    function connect()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->baseName,
                $this->user,
                $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }

    function disconnect()
    {
        $this->conn = null;
    }

    function getOne($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $response = $stmt->fetch();

        return $response;
    }

    function getAll($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $response = $stmt->fetchAll();

        return $response;
    }

    function executeRun($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);

        return $stmt->execute($params);
    }
}