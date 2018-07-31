<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

class Supplier
{
    public $id;
    public $name;
    public $description;
    public $email;
    public $telefone;
   
    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->telefone = $data['telefone'] ?? null;
       }
}