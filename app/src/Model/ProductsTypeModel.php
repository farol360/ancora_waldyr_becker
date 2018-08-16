<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\ProductsType;

class ProductsTypeModel extends Model
{
    public function add(ProductsType $products_type)
    {
        $sql = "
            INSERT INTO products_type (
                name,
                description

                )
            VALUES (:name, :description)
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':name'          => $products_type->name,
            ':description'   => $products_type->description,


        ];
        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return null;
        }
    }

    public function delete(int $id): bool
    {
       $sql = "DELETE FROM products_type WHERE id = :id";
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
                products_type
            WHERE
                id = :id
            LIMIT 1
        ";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, ProductsType::class);
        return $query->fetch();
    }

    public function getAll(): array
    {
        $sql = "
            SELECT
               *
            FROM
                products_type
            ORDER BY
                id ASC
        ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, ProductsType::class);
        return $query->fetchAll();
    }

    public function update(ProductsType $products_type): bool
    {
        $sql = "
            UPDATE
                products_type
            SET
                name         = :name,
                description  = :description
            WHERE
                id = :id
        ";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':id'           => $products_type->id,
            ':name'         => $products_type->name,
            ':description'  => $products_type->description
        ];
        return $query->execute($parameters);
    }
}
