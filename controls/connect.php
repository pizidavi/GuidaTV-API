<?php

class Database {

  private $pdo;

  function __construct($host, $username, $password, $database) {
    try {
      $this->pdo = new PDO("mysql:host={$host};dbname={$database}", $username, $password, array(PDO::ATTR_PERSISTENT => true));
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->exec("set names utf8");
    }
    catch(PDOException $exception){
      die("DB Connection error: ".$exception->getMessage());
    }
  }

  function query() {
    $query = func_get_arg(0);
    $params = array();

    for ($i=1; $i < count(func_get_args()); $i++) {
      $params[] = func_get_arg($i);
    }

    $result = $this->pdo->prepare($query);
    $result->execute($params);
    return $result;
  }

  function bind() {
    $query = func_get_arg(0);
    $params = func_get_arg(1);

    $result = $this->pdo->prepare($query);
    foreach ($params as $key => &$value) {
      $result->bindParam((gettype($key) == "integer" ? $key+1 : $key), $value);
    }

    $result->execute();
    return $result;
  }

  function getLastInsertId() {
    return $this->pdo->lastInsertId();
  }

}

 ?>
