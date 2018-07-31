<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\Supplier;

class SupplierModel extends Model
{
    public function add(Supplier $supplier)
    {
        $sql = "
            INSERT INTO suppliers (
                name,
                description,
                email,
                telefone
                )
            VALUES (:name, :description, :email, :telefone)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':name'          => $supplier->name,
            ':description'   => $supplier->description,
            ':email'      => $supplier->email,
            ':telefone'      => $supplier->telefone,

        ];
        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }

    public function delete(int $id): bool
    {
       $sql = "DELETE FROM suppliers WHERE id = :id";
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
                suppliers
            WHERE
                id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Supplier::class);
        return $query->fetch();
    }

    public function getAll(): array
    {
        $sql = "
            SELECT
               *
            FROM
                suppliers
            ORDER BY
                id ASC
        ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Supplier::class);
        return $query->fetchAll();
    }

    public function update(Supplier $supplier): bool
    {
        $sql = "
            UPDATE
                suppliers
            SET
                name         = :name,
                description  = :description,
                email        = :email,
                telefone     = :telefone
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':id'           => $supplier->id,
            ':name'         => $supplier->name,
            ':description'  => $supplier->description,
            ':email'     => $supplier->email,
            ':telefone'     => $supplier->telefone
        ];
        return $query->execute($parameters);
    }
}
