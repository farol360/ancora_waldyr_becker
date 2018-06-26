<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

class Attendance
{
    public $id;
    public $id_patient;
    public $id_professional;
    public $data;
    public $time;
    public $description;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->id_patient = $data['id_patient'] ?? null;
        $this->id_professional = $data['id_professional'] ?? null;
        $this->data = $data['data'] ?? null;
        $this->time = $data['time'] ?? null;
        $this->description = $data['description'] ?? null;
    }
}
