<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'full_name' => $this->name.' '.$this->last_name,
            'tax_id_number' => $this->tax_id_number,
            'email' => $this->email,
            'contracts' => ContractResource::collection($this->whenLoaded('contracts')),
        ];
    }
}
