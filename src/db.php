<?php

class Database {
  private static ?PDO $instance = null;

  public static function getInstance(): PDO {
    if (self::$instance === null) {
      $host = 'mariadb';
      $dbname = 'todo';
      $username = 'mariadb';
      $password = 'mariadb';

      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ];

      try {
        self::$instance = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password, $options);
      } catch (PDOException $error) {
        die($error->getMessage());
      }
    }

    return self::$instance;
  }
}
