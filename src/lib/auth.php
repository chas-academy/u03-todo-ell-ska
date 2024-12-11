<?php
require_once 'db.php';

class Auth {
  public static function register(string $username, string $password) {
    $username = htmlspecialchars(trim($username));
    $password = htmlspecialchars(trim($password));

    if (empty($username) || empty($password)) {
      die('Username and password are required');
    }

    $db = Database::getInstance();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
      $query = $db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
      $query->execute(['username' => $username, 'password' => $hashedPassword]);
    } catch (PDOException $error) {
      die($error->getMessage());
    }
  }
}
