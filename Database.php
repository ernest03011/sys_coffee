<?php

class Database
{
  public $connection;
  public $statement;

  public function __construct($config)
  {
    $dsn = 'mysql:' . http_build_query($config, '', ';');

    $this->connection = new PDO($dsn, /* username */ null, /* password */ null, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

  }

  public function query($query, $params = [])
  {
    $this->statement = $this->connection->prepare($query);
    $this->statement->execute($params);

    return $this;
  }

  public function get(){
    return $this->statement->fetchAll();
  }

  public function find(){
    return $this->statement->fetch();
  }

  public function findOrFail(){
    $result = $this->find();

    if(! $result){
      abort();
    }

    return $result;
  }

  public function killConnection(){
    $this->connection = null;
  }


}
  