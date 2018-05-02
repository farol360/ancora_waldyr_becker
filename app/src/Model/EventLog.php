<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

class EventLog
{
    public $id;
    public $id_event_log_type;
    public $id_patient;
    public $id_professional;
    public $date;
    public $description;


    public function __construct(array $data = [])
    {
        $this->id                  = $data['id'] ?? null;
        $this->id_event_log_type   = $data['id_event_log_type'] ?? null;
        $this->date                = $data['date'] ?? null;
        $this->description         = $data['description'] ?? null;
        $this->id_patient          = $data['id_patient'] ?? null;
        $this->id_professional     = $data['id_professional'] ?? null;
    }
}
