<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\ProfessionalType;

class ProfessionalTypeModel extends Model
{
    public function add(ProfessionalType $professional_type)
    {
        $sql = "
            INSERT INTO professional_types (
                name,
                description
                )
            VALUES (:name, :description)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':name'          => $professional_type->name,
            ':description'   => $professional_type->description,

        ];
        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }

    public function delete(int $id): bool
    {
       $sql = "DELETE FROM professional_types WHERE id = :id";
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
                professional_types
            WHERE
                id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, ProfessionalType::class);
        return $query->fetch();
    }

    public function getAll(): array
    {
        $sql = "
            SELECT
               *
            FROM
                professional_types
            ORDER BY
                id ASC
        ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, ProfessionalType::class);
        return $query->fetchAll();
    }

    public function update(ProfessionalType $professional_type): bool
    {
        $sql = "
            UPDATE
                professional_types
            SET
                name         = :name,
                description  = :description
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':id'           => $professional_type->id,
            ':name'         => $professional_type->name,
            ':description'  => $professional_type->description
        ];
        return $query->execute($parameters);
    }
}
