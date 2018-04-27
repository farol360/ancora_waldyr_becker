<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\Disease;

class DiseaseModel extends Model
{
    public function add(Disease $disease)
    {
        $sql = "
            INSERT INTO diseases (
                name,
                description,
                cid_version,
                cid_code
                )
            VALUES (:name, :description, :cid_version, :cid_code)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':name'             => $disease->name,
            ':description'      => $disease->description,
            ':cid_version'      => $disease->cid_version,
            ':cid_code'         => $disease->cid_code

        ];
        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }

    public function delete(int $id): bool
    {
       $sql = "DELETE FROM diseases WHERE id = :id";
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
                diseases
            WHERE
                id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Disease::class);
        return $query->fetch();
    }

    public function getAll(int $offset = 0, int $limit = PHP_INT_MAX): array
    {
        $sql = "
            SELECT
                *
            FROM
                diseases
            ORDER BY
                cid_version, cid_code
            LIMIT ? , ?
        ";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, $offset, \PDO::PARAM_INT);
        $query->bindValue(2, $limit, \PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Disease::class);
        return $query->fetchAll();
    }

    public function update(Disease $disease): bool
    {
        $sql = "
            UPDATE
                disease
            SET
                name            = :name,
                description     = :description,
                cid_version     = :cid_version,
                cid_code        = :cid_code
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':name'            => $disease->name,
            ':description'     => $disease->description,
            ':cid_version'     => $disease->cid_version,
            ':cid_code'        => $disease->cid_code,
            ':id'              => $disease->id
        ];
        return $query->execute($parameters);
    }
}
