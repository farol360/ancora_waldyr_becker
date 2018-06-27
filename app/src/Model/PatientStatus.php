<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

class PatientStatus
{
    public $id;
    public $name;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;

    }
}
