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

    public function getByPatient(int $id)
    {
        $sql = "
            SELECT
                event_logs.id as id,
                event_logs.id_event_log_type,
                event_logs.id_patient,
                event_logs.id_professional,
                event_logs.date,
                event_logs.description,
                event_log_types.id as event_log_types_id,
                event_log_types.slug as event_log_types_slug,
                event_log_types.name as event_log_types_name,
                event_log_types.description as event_log_types_description,
                patients.id as patients_id,
                patients.id_user as patients_id_user,
                users.name as users_name,
                users.email as users_email

            FROM
                event_logs
                LEFT JOIN event_log_types ON event_logs.id_event_log_type = event_log_types.id
                LEFT JOIN patients ON patients.id = event_logs.id_patient
                LEFT JOIN users ON patients.id_user = users.id
            WHERE
                id_patient = :id

        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, EventLog::class);
        return $query->fetchAll();
    }

    public function getByProfessional(int $id)
    {
        $sql = "
            SELECT
                event_logs.id as id,
                event_logs.id_event_log_type,
                event_logs.id_patient,
                event_logs.id_professional,
                event_logs.date,
                event_logs.description,
                event_log_types.id,
                event_log_types.slug,
                event_log_types.name,
                event_log_types.description,
                professionals.id,
                professionals.id_user,
                users.name,
                users.email

            FROM
                event_logs
                LEFT JOIN event_log_types ON event_logs.id_event_log_type = event_log_types.id
                LEFT JOIN professionals ON professionals.id = event_logs.id_professional
                LEFT JOIN users ON professionals.id_user = users.id
            WHERE
                id_professional = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, EventLog::class);
        return $query->fetch();
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
