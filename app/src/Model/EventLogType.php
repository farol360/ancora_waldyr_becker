<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

class EventLogType
{
    public $id;
    public $slug;
    public $name;
    public $description;


    public function __construct(array $data = [])
    {
        $this->id                  = $data['id'] ?? null;
        $this->slug                = $data['slug'] ?? null;
        $this->name                = $data['name'] ?? null;
        $this->description         = $data['description'] ?? null;
        }
}
