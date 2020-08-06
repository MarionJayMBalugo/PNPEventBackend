<?php

namespace App\Http\Resources\Events;

use Illuminate\Http\Resources\Json\JsonResource;

class Events extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'id' =>$this->id,
            'event_name' => $this->event_name,
            'host' => $this->host,
            'event_date' => $this->event_date,
        ];
    }
}
