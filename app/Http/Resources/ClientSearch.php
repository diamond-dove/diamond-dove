<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ClientSearch extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'identifier' => $this->identifier,
            'sector'     => $this->sector,
            'debt'       => $this->debt,
            'cell_phone' => $this->cell_phone,
            'address'    => $this->address,
        ];
    }
}
