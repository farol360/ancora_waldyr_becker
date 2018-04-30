<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\PatientType;

class PatientTypeModel extends Model
{
    public function add(PatientType $patient_type)
    {
        $sql = "
            INSERT INTO patient_types (
                name,
                description
                )
            VALUES (:name, :description)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':name'          => $patient_type->name,
            ':description'   => $patient_type->description,

        ];
        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }

    public function delete(int $id): bool
    {
       $sql = "DELETE FROM patient_types WHERE id = :id";
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
                patient_types
            WHERE
                id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, PatientType::class);
        return $query->fetch();
    }

    public function getAll(): array
    {
        $sql = "
            SELECT
               *
            FROM
                patient_types
            ORDER BY
                id ASC
        ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, PatientType::class);
        return $query->fetchAll();
    }

    public function update(PatientType $patient_type): bool
    {
        $sql = "
            UPDATE
                patient_types
            SET
                name         = :name,
                description  = :description
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':name'          => $patient->name,
            ':description'  => $patient->description
        ];
        return $query->execute($parameters);
    }
}
