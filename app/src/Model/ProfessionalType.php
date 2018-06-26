<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

class ProfessionalType
{
    public $id;
    public $name;
    public $description;
    public $register;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->register = $data['register'] ?? null;

    }
}
