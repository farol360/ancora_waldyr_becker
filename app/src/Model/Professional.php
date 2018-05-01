<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

class Professional
{
    public $id;
    public $id_user;
    public $id_professional_type;


    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->id_user = $data['id_user'] ?? null;
        $this->id_professional_type = $data['id_professional_type'] ?? null;

    }
}
