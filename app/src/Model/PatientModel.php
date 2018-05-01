<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\Patient;

class PatientModel extends Model
{
    public function add(Patient $patient)
    {
        $sql = "
            INSERT INTO patients (
                id_user,
                id_patient_type,
                id_disease
                )
            VALUES (:id_user, :id_patient_type, :id_disease)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':id_user'          => $patient->id_user,
            ':id_patient_type'  => $patient->id_patient_type,
            ':id_disease'       => $patient->id_disease

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
                users.*,
                patients.id as patient_id,
                diseases.id as disease_id,
                diseases.name as disease_name,
                diseases.description as disease_description,
                diseases.cid_version as disease_cid_version,
                diseases.cid_code as diseases_cid_code
            FROM
                patients LEFT JOIN users ON users.id = patients.id_user
            LEFT JOIN diseases ON patients.id_disease = diseases.id
            WHERE
                patients.id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Patient::class);
        return $query->fetch();
    }

    public function getByEmail(string $email) {
        $sql = "
            SELECT
                *
            FROM
                users
            WHERE
                email = :email
            LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = [':email' => $email];
        $query->execute($parameters);
        return $query->fetch();
    }

    public function getAll(): array
    {
        $sql = "
            SELECT
                users.*,
                patients.*,
                diseases.id as disease_id,
                diseases.name as disease_name,
                diseases.description as disease_description,
                diseases.cid_version as disease_cid_version,
                diseases.cid_code as disease_cid_code
            FROM
                patients LEFT JOIN users ON users.id = patients.id_user
            LEFT JOIN diseases ON patients.id_disease = diseases.id
            ORDER BY
                patients.id ASC
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
                id_patient_type = :id_patient_type,
                id_disease      = :id_disease
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':id_user'          => $patient->id_user,
            ':id_patient_type'  => $patient->id_patient_type,
            ':id_disease'       => $patient->id_disease,
            ':id'               => $patient->id
        ];
        return $query->execute($parameters);
    }
}
