<?php

class Database
{
  public $connection;

  public function __construct()
  {
    $dsn = "mysql:host=localhost;port=3306;dbname=coffee_db;user=root;password=anaphoric-panchions-sdeign;charset=utf8mb4";

    $this->connection = new PDO($dsn);
  }

  public function query($query)
  {
    $statement = $this->connection->prepare($query);
    $statement->execute();

    return $statement;
  }
}