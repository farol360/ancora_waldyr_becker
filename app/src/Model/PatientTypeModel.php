<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\PatientType;

class PatientTypeModel extends Model
{
    public function add(Patient $patient)
    {
        $sql = "
            INSERT INTO patients (
                name,
                description
                )
            VALUES (:name, :description)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':name'          => $patient->name,
            ':description'  => $patient->description,

        ];
        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }

    public function delete(int $id): bool
    {
       $sql = "DELETE FROM patients WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        return $query->execute($parameters);
    }

    public function get(int $id)
    {
        $sql = "
            SELECT
                patients.*,
                users.*
            FROM
                patients LEFT JOIN users ON users.id = patients.id_user
            WHERE
                id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Patient::class);
        return $query->fetch();
    }

    public function getAll(): array
    {
        $sql = "
            SELECT
                patients.*,
                users.*
            FROM
                patients LEFT JOIN users ON users.id = patients.id_user
            ORDER BY
                id ASC
        ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Patient::class);
        return $query->fetchAll();
    }

    public function update(Patient $patient): bool
    {
        $sql = "
            UPDATE
                patients
            SET
                id_user         = :id_user,
                id_patient_type = :id_patient_type
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':id_user'          => $patient->id_user,
            ':id_patient_type'  => $patient->id_patient_type,
            ':id'               => $patient->id
        ];
        return $query->execute($parameters);
    }
}
