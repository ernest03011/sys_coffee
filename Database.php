<?php

class Database
{
  public $connection;

  public function __construct()
  {
    $config = require 'config.php';
    $databaseSettings = $config['database'];

    $host = $databaseSettings['host'];
    $user = $databaseSettings['user'];
    $port = $databaseSettings['port'];
    $dbname = $databaseSettings['dbname'];
    $charset = $databaseSettings['charset'];
    $password = $databaseSettings['password'];

    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password;charset=$charset";

    $this->connection = new PDO($dsn);
  }

  public function query($query)
  {
    $statement = $this->connection->prepare($query);
    $statement->execute();

    return $statement;
  }
}