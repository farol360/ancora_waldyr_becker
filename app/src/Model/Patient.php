<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

class Patient
{
    public $id;
    public $id_user;
    public $id_patient_type;
    public $id_disease;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->id_user = $data['id_user'] ?? null;
        $this->id_patient_type = $data['id_patient_type'] ?? null;
        $this->id_disease = $data['id_disease'] ?? null;

    }
}
