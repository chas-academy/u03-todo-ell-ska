<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/../utils/navigation.php';
require_once __DIR__ . '/../utils/validation.php';

class Lists
{
    private static function setup()
    {
        return [Auth::getUser(), Database::getInstance()];
    }

    public static function create($name)
    {
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

    public static function delete($id)
    {
        $id = validateString($id, true, 'Id is required');

        [$user, $db] = self::setup();

        try {
            $query = $db->prepare('
        DELETE
        FROM lists
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

    public static function getAll()
    {
        [$user, $db] = self::setup();

        $query = $db->prepare("
      SELECT name, id
      FROM lists
      WHERE user_id = :id
    ");

        $query->execute([
        'id' => $user['id']
        ]);

        return $query->fetchAll();
    }

    public static function getName($id)
    {
        if (!isset($id) || !validateString($id)) {
            throw new Exception('id is invalid');
        }

        [$user, $db] = self::setup();

        $query = $db->prepare("
      SELECT (name)
      FROM lists
      WHERE id = :id
        AND user_id = :userId
    ");

        $query->execute([
        'id' => $id,
        'userId' => $user['id']
        ]);

        return $query->fetchColumn();
    }
}
