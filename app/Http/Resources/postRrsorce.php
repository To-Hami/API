<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class postRrsorce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'key'     => $this->id,
            'content' =>str_split($this->body  ,20)  ,
            'head'    => $this->title,
        ];
    }
}
