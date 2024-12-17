<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IntegerConversionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'integer' => $this->integer,
            'conversion' => $this->conversion,
            'count' => $this->when(!is_null($this->count), $this->count),
            'created_at' => $this->created_at,
        ];
    }
}
