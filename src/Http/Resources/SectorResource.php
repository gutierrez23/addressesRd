<?php

namespace FgutierrezPHP\AddresesRd\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'label' => $this->name,
            'value' => $this->id,
            'municipality' => $this->whenLoaded('municipality'),
            'agencies_count' => $this->whenLoaded('agencies', function () {
                return $this->agencies->count();
            }),
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('d/m/Y')
        ];
    }
}
