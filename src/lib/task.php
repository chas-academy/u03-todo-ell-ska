<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/../utils/navigation.php';
require_once __DIR__ . '/../utils/validation.php';

class Task {
  private static function setup() {
    return [Auth::getUser(), Database::getInstance()];
  }

  public static function create($name, $note, $deadline, $scheduled, $done, $listId) {
    $name = validateString($name, true, 'Task name is required');
    $note = validateString($note);
    $deadline = validateString($deadline);;
    $scheduled = validateString($scheduled);
    $done = validateString($done) ?? '0';
    $listId = validateString($listId);

    [$user, $db] = self::setup();

    try {
      $query = $db->prepare('INSERT INTO tasks (name, note, deadline, scheduled, done, list_id, user_id) VALUES (:name, :note, :deadline, :scheduled, :done, :listId, :userId)');
      $query->execute(['name' => $name, 'note' => $note, 'deadline' => $deadline, 'scheduled' => $scheduled, 'done' => $done, 'listId' => $listId, 'userId' => $user['id']]);

      refresh();
    } catch (PDOException $error) {
      die($error->getMessage());
    }
  }

  public static function toggleDone($id) {
    $id = validateString($id, true, 'Task id is required');

    [$user, $db] = self::setup();

    try {
      $query = $db->prepare('UPDATE tasks SET done = !done WHERE id = :id AND user_id = :userId');
      $query->execute(['id' => $id, 'userId' => $user['id']]);

      refresh();
    } catch (PDOException $error) {
      die($error->getMessage());
    }
  }

  public static function edit($id, $name, $note, $deadline, $scheduled, $listId, $callback = null) {
    $id = validateString($id, true, 'Task id is required');
    $name = validateString($name, true, 'Task name is required');
    $note = validateString($note);
    $deadline = validateString($deadline);
    $scheduled = validateString($scheduled);
    $listId = validateString($listId);
    $callback = validateString($callback);

    [$user, $db] = self::setup();

    try {
      $query = $db->prepare('UPDATE tasks
        SET
          name = :name,
          note = :note,
          deadline = :deadline,
          scheduled = :scheduled,
          list_id = :listId
        WHERE id = :id AND user_id = :userId');
      $query->execute(['name' => $name, 'note' => $note, 'deadline' => $deadline, 'scheduled' => $scheduled, 'listId' => $listId, 'id' => $id, 'userId' => $user['id']]);

      if ($callback) {
        redirect($callback);
      } else {
        redirect('/');
      }
    } catch (PDOException $error) {
      die($error->getMessage());
    }
  }

  public static function delete($id) {
    $id = validateString($id, true, 'Task id is required');

    [$user, $db] = self::setup();

    try {
      $query = $db->prepare('DELETE FROM tasks WHERE id = :id AND user_id = :userId');
      $query->execute(['id' => $id, 'userId' => $user['id']]);

      redirect('/');
    } catch (PDOException $error) {
      die($error->getMessage());
    }
  }
}
