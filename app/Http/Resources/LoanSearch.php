<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class LoanSearch extends JsonResource
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
            'name'       => $this->client->name,
            'identifier' => $this->client->identifier,
            'created_at'     => date('d-m-Y', strtotime($this->created_at)),
            'amount'       => $this->amount,
        ];
    }
}
