<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\PatientStatus;

class PatientStatusModel extends Model
{
    public function add(PatientStatus $patient_status)
    {
        $sql = "
            INSERT INTO patient_status (
                name
                )
            VALUES (:name)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':name'          => $patient_status->name,


        ];
        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }

    public function delete(int $id): bool
    {
       $sql = "DELETE FROM patient_status WHERE id = :id";
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
                patient_status
            WHERE
                id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, PatientStatus::class);
        return $query->fetch();
    }

    public function getAll(): array
    {
        $sql = "
            SELECT
               *
            FROM
                patient_status
            ORDER BY
                id ASC
        ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, PatientStatus::class);
        return $query->fetchAll();
    }

    public function update(PatientStatus $patient_status): bool
    {
        $sql = "
            UPDATE
                patient_status
            SET
                name         = :name
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':name'          => $patient->name
        ];
        return $query->execute($parameters);
    }
}
