<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\Remessa;

class RemessaModel extends Model
{
    public function add(Remessa $remessa)
    {
        $sql = "
            INSERT INTO remessa (
                quantity,
                type
                )
            VALUES (:quantity, :type)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':quantity'          => $remessa->quantity,
            ':type'              => $remessa->type,

        ];
        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }

    public function delete(int $id): bool
    {
       $sql = "DELETE FROM remessa WHERE id = :id";
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
                remessa
            WHERE
                id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Remessa::class);
        return $query->fetch();
    }

    public function getAll(): array
    {
        $sql = "
            SELECT
               *
            FROM
                remessa
            ORDER BY
                id ASC
        ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Remessa::class);
        return $query->fetchAll();
    }

    public function update(Remessa $remessa): bool
    {
        $sql = "
            UPDATE
                remessa
            SET
                quantity         = :quantity,
                type             = :type
               
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':id'           => $remessa->id,
            ':quantity'     => $remessa->quantity,
            ':type'         => $remessa->type
            ];
        return $query->execute($parameters);
    }
}
