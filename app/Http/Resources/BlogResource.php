<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'title' => $this->title ,
            'content' => $this->content ,
            'short_content' => $this->short_content ,
            'image' => $this->image_full_path ,
            'publish_date' => $this->publish_date ,
            'status' => $this->status ,
        ];
    }
}
