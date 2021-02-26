<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharCodeResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->char_code;
    }
}
