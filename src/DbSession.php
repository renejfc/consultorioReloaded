<?php

namespace App;

use PDO;
use PDOException;

class DbSession
{

  public $mysql;

  public function __construct()
  {
    try {
      $this->mysql = $this->getConnection();
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }

  private function getConnection()
  {
      $host = "eu-cdbr-west-03.cleardb.net";
      $user = "bfdcbdf4f583cf";
      $pass = "33f5745e";
      $database = "heroku_09710e094e5fc4a";
      $charset = "utf-8";
      $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
      $pdo = new pdo("mysql:host={$host};dbname={$database};charset{$charset}", $user, $pass, $options);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    }
  }

