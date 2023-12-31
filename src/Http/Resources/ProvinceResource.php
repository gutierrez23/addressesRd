<?php

namespace FgutierrezPHP\AddresesRd\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
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
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'agencies_count' => $this->whenLoaded('agencies', function () {
                return $this->agencies->count();
            })
        ];
    }
}
