<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

class Remessa
{
    public $id;
    public $quantity;
    public $type;
   
    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->quantity = $data['quantity'] ?? null;
        $this->type = $data['type'] ?? null;
     }
}