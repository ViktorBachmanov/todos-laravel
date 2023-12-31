<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\TagResource;
use App\Http\Resources\ImageResource;


class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
          'id' => $this->id,
          'text' => $this->text,
          'tags' => TagResource::collection($this->tags),
          'previewImage' => new ImageResource($this->getPreviewImage()),
          'fullImage' => new ImageResource($this->getFullImage()),
        ];
    }
}
