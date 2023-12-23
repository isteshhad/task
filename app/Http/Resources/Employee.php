<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employee extends JsonResource
{


    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'contact' => $this->contact,
            'address' => $this->address,
            'created_at' => $this->created_at->format('dd/mm/yyyy'),
            'updated_at' => $this->updated_at->format('dd/mm/yyyy'),
        ];
    }
}
