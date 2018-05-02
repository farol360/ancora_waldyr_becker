<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\EventLog;

class EventLogModel extends Model
{
    public function add(EventLog $eventLog)
    {
        $sql = "
            INSERT INTO event_logs (
                id_event_log_type,
                date,
                description,
                id_patient,
                id_professional
                )
            VALUES (
                :id_event_log_type,
                :date,
                :description,
                :id_patient,
                :id_professional)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':id_event_log_type'    => $eventLog->id_event_log_type,
            ':date'                 => $eventLog->date,
            ':description'          => $eventLog->description,
            ':id_patient'           => $eventLog->id_patient,
            ':id_professional'      => $eventLog->id_professional

        ];
        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }

    public function delete(int $id): bool
    {
       $sql = "DELETE FROM event_logs WHERE id = :id";
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
                event_logs
            WHERE
                id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, EventLog::class);
        return $query->fetch();
    }

    public function getAll(int $offset = 0, int $limit = PHP_INT_MAX): array
    {
        $sql = "
            SELECT
                *
            FROM
                event_logs
            ORDER BY
                date
            LIMIT ? , ?
        ";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, $offset, \PDO::PARAM_INT);
        $query->bindValue(2, $limit, \PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, EventLog::class);
        return $query->fetchAll();
    }

    public function update(EventLog $eventLog): bool
    {
        $sql = "
            UPDATE
                event_logs
            SET
                id_event_log_type   = :id_event_log_type,
                date                = :date,
                description         = :description,
                id_patient          = :id_patient,
                id_professional     = :id_professional
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':id_event_log_type'=> $eventLog->id_event_log_type,
            ':date'             => $eventLog->date,
            ':description'      => $eventLog->description,
            ':id_patient'       => $eventLog->id_patient,
            ':id_professional'  => $eventLog->id_professional,
            ':id'               => $eventLog->id
        ];
        return $query->execute($parameters);
    }
}
