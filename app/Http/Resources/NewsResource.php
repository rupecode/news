<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $out = parent::toArray($request);
        $out['created'] = $this->resource->created;
        $out['owner']['id'] = $this->resource->owner->id;
        $out['owner']['name'] = $this->resource->owner->name;
        $out['owner']['image'] = $this->resource->owner->image;

        return $out;
    }
}
