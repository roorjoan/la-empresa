<?php

namespace App\Http\Resources;

use App\Models\ContractType;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $contract_type_name = ContractType::select('name')->where('id', $this->contract_type_id)->get();

        return [
            'contract_type' => $contract_type_name,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'salary_per_day' => $this->salary_per_day,
            'is_active' => ($this->is_active == '1') ? true : false,
        ];
    }
}
