<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/../utils/navigation.php';
require_once __DIR__ . '/../utils/validation.php';

class Tasks
{
    private static function setup()
    {
        return [Auth::getUser(), Database::getInstance()];
    }

    public static function create($name, $note, $deadline, $scheduled, $done, $listId)
    {
        $name = validateString($name, true, 'Task name is required');
        $note = validateString($note);
        $deadline = validateString($deadline);
        ;
        $scheduled = validateString($scheduled);
        $done = validateString($done) ?? '0';
        $listId = validateString($listId);

        [$user, $db] = self::setup();

        try {
            $query = $db->prepare('
        INSERT INTO tasks (name, note, deadline, scheduled, done, list_id, user_id)
        VALUES (:name, :note, :deadline, :scheduled, :done, :listId, :userId)
      ');

            $query->execute([
            'name' => $name,
            'note' => $note,
            'deadline' => $deadline,
            'scheduled' => $scheduled,
            'done' => $done,
            'listId' => $listId,
            'userId' => $user['id']
            ]);

            refresh();
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public static function toggleDone($id)
    {
        $id = validateString($id, true, 'Task id is required');

        [$user, $db] = self::setup();

        try {
            $query = $db->prepare('
        UPDATE tasks
        SET done = !done
        WHERE id = :id
          AND user_id = :userId
      ');

            $query->execute([
            'id' => $id,
            'userId' => $user['id']
            ]);

            refresh();
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public static function edit($id, $name, $note, $deadline, $scheduled, $listId, $callback = null)
    {
        $id = validateString($id, true, 'Task id is required');
        $name = validateString($name, true, 'Task name is required');
        $note = validateString($note);
        $deadline = validateString($deadline);
        $scheduled = validateString($scheduled);
        $listId = validateString($listId);
        $callback = validateString($callback);

        [$user, $db] = self::setup();

        try {
            $query = $db->prepare('
        UPDATE tasks
        SET name = :name,
            note = :note,
            deadline = :deadline,
            scheduled = :scheduled,
            list_id = :listId
        WHERE id = :id
          AND user_id = :userId
      ');
            $query->execute([
            'name' => $name,
            'note' => $note,
            'deadline' => $deadline,
            'scheduled' => $scheduled,
            'listId' => $listId,
            'id' => $id,
            'userId' => $user['id']
            ]);

            if ($callback) {
                  redirect($callback);
            } else {
                redirect('/');
            }
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public static function delete($id)
    {
        $id = validateString($id, true, 'Task id is required');

        [$user, $db] = self::setup();

        try {
            $query = $db->prepare('
        DELETE
        FROM tasks
        WHERE id = :id
          AND user_id = :userId
      ');

            $query->execute([
            'id' => $id,
            'userId' => $user['id']
            ]);

            redirect('/');
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public static function getIndex()
    {
        [$user, $db] = self::setup();

        $query = $db->prepare("
      SELECT *
      FROM tasks
      WHERE user_id = :id
        AND list_id IS NULL
        AND done = 0
      ORDER BY CASE
                  WHEN deadline IS NULL THEN 1
                  ELSE 0
              END ASC, deadline ASC,
                        CASE
                            WHEN scheduled IS NULL THEN 1
                            ELSE 0
                        END ASC, scheduled ASC,
                                created_at DESC
    ");

        $query->execute([
        'id' => $user['id']
        ]);

        return $query->fetchAll();
    }

    public static function getToday()
    {
        [$user, $db] = self::setup();

        $query = $db->prepare("
      SELECT tasks.id,
             tasks.name,
             tasks.note,
             tasks.done,
             tasks.scheduled,
             tasks.deadline,
             lists.name AS list
      FROM tasks
      LEFT JOIN lists ON tasks.list_id = lists.id
      WHERE tasks.user_id = :id
        AND done = 0
        AND ((deadline IS NOT NULL
              AND deadline <= CURRENT_DATE)
            OR (scheduled IS NOT NULL
                AND scheduled <= CURRENT_DATE))
      ORDER BY CASE
                    WHEN deadline IS NULL THEN 1
                    ELSE 0
                END ASC, deadline ASC,
                        CASE
                            WHEN scheduled IS NULL THEN 1
                            ELSE 0
                        END ASC, scheduled ASC
    ");

        $query->execute([
        'id' => $user['id']
        ]);

        return $query->fetchAll();
    }

    public static function getDone()
    {
        [$user, $db] = self::setup();

        $query = $db->prepare("
      SELECT tasks.id,
             tasks.name,
             tasks.note,
             tasks.done,
             tasks.scheduled,
             tasks.deadline,
             lists.name AS list
      FROM tasks
      LEFT JOIN lists ON tasks.list_id = lists.id
      WHERE tasks.user_id = :id
        AND done = 1
      ORDER BY tasks.created_at DESC
    ");

        $query->execute([
        'id' => $user['id']
        ]);

        return $query->fetchAll();
    }

    public static function geList($id)
    {
        if (!isset($id) || !validateString($id)) {
            throw new Exception('id is invalid');
        }

        [$user, $db] = self::setup();

        $query = $db->prepare("
      SELECT *
      FROM tasks
      WHERE user_id = :userId
        AND list_id = :listId
        AND done = 0
      ORDER BY CASE
                   WHEN deadline IS NULL THEN 1
                   ELSE 0
               END ASC, deadline ASC,
                        CASE
                            WHEN scheduled IS NULL THEN 1
                            ELSE 0
                        END ASC, scheduled ASC,
                                 created_at DESC
    ");

        $query->execute([
        'userId' => $user['id'],
        'listId' => $id
        ]);

        return $query->fetchAll();
    }
}
