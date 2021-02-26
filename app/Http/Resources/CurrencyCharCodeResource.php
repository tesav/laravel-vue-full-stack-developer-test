<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyCharCodeResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->char_code;
    }
}
