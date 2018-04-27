<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

class Disease
{
    public $id;
    public $name;
    public $description;
    public $cid_version;
    public $cid_code;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->cid_version = $data['cid_version'] ?? null;
        $this->cid_code = $data['cid_code'] ?? null;
    }
}
