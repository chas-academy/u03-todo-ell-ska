<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../utils/navigation.php';
require_once __DIR__ . '/../utils/session-start-unless-started.php';

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

      self::login($username, $password);
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

  public static function logOut() {
    sessionStartUnlessStarted();

    unset($_SESSION['user_id']);
    unset($_SESSION['username']);

    redirect('/log-in.php');
  }

  public static function getUser() {
    sessionStartUnlessStarted();

    $id = $_SESSION['user_id'] ?? null;
    $username = $_SESSION['username'] ?? null;

    if (!$id || !$username) {
      return null;
    }

    return ["id" => $id, "username" => $username];
  }

  public static function deleteUser() {
    $db = Database::getInstance();
    $user = self::getUser();

    if (!$user['id']) {
      redirect('/log-in.php');
    }

    try {
      $query = $db->prepare('DELETE FROM users WHERE id = :id');
      $query->execute(['id' => $user['id']]);

      self::logOut();

      redirect('/sign-up.php');
    } catch (PDOException $error) {
      die($error->getMessage());
    }
  }
}
