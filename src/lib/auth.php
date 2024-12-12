<?php
require_once 'db.php';
require_once 'utils/redirect.php';
require_once 'utils/session-start-unless-started.php';

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

      redirect('/log-in.php');
    } catch (PDOException $error) {
      die($error->getMessage());
    }
  }

  public static function login(string $username, string $password) {
    $username = htmlspecialchars(trim($username));
    $password = htmlspecialchars(trim($password));

    if (empty($username) || empty($password)) {
      die('Username and password are required');
    }

    $db = Database::getInstance();

    try {
      $query = $db->prepare('SELECT id, username, password FROM users WHERE username = :username');
      $query->execute(['username' => $username]);
      $user = $query->fetch();

      sessionStartUnlessStarted();

      if (!$user || !password_verify($password, $user['password'])) {
        $_SESSION['error'] = 'Invalid username or password';
        redirect('/log-in.php');
      }

      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];

      redirect('/');
    } catch (PDOException $error) {
      die($error->getMessage());
    }
  }

  public static function getUser() {
    sessionStartUnlessStarted();

    $id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    if (!$id) {
      return null;
    }

    return ["id" => $id, "username" => $username];
  }
}
