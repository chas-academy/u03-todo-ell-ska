<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/../utils/navigation.php';
require_once __DIR__ . '/../utils/validation.php';

class Lists {
  private static function setup() {
    return [Auth::getUser(), Database::getInstance()];
  }

  public static function create($name) {
    $name = validateString($name, true, 'List name is required');

    [$user, $db] = self::setup();

    try {
      $query = $db->prepare('
        INSERT INTO lists (name, user_id)
        VALUES (:name, :userId) RETURNING id
      ');

      $query->execute([
        'name' => $name,
        'userId' => $user['id']
      ]);

      $id = $query->fetchColumn();

      redirect("/list.php?id=$id");
    } catch (PDOException $error) {
      die($error->getMessage());
    }
  }
}
