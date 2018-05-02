<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\EventLogType;

class EventLogTypeModel extends Model
{
    public function add(EventLogType $eventLogType)
    {
        $sql = "
            INSERT INTO event_log_types (
                slug,
                name,
                description
                )
            VALUES (
                :slug,
                :name,
                :description)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':slug'              => $eventLogType->slug,
            ':name'              => $eventLogType->name,
            ':description'       => $eventLogType->description
        ];
        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }

    public function delete(int $id): bool
    {
       $sql = "DELETE FROM event_log_types WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        return $query->execute($parameters);
    }

    public function get(int $id)
    {
        $sql = "
            SELECT
                *
            FROM
                event_log_types
            WHERE
                id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, EventLogType::class);
        return $query->fetch();
    }

    public function getBySlug(string $slug)
    {
        $sql = "
            SELECT
                *
            FROM
                event_log_types
            WHERE
                slug = :slug
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':slug' => $slug];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, EventLogType::class);
        return $query->fetch();
    }

    public function getAll(int $offset = 0, int $limit = PHP_INT_MAX): array
    {
        $sql = "
            SELECT
                *
            FROM
                event_log_types
            ORDER BY
                id
            LIMIT ? , ?
        ";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, $offset, \PDO::PARAM_INT);
        $query->bindValue(2, $limit, \PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, EventLogType::class);
        return $query->fetchAll();
    }

    public function update(EventLogType $eventLogType): bool
    {
        $sql = "
            UPDATE
                event_log_types
            SET
                slug        = :slug,
                name        = :name,
                description = :description
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':slug'        => $eventLogType->slug,
            ':name'        => $eventLogType->name,
            ':description' => $eventLogType->description,
            ':id'          => $eventLog->id
        ];
        return $query->execute($parameters);
    }
}
