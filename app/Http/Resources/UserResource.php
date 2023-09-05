<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id ?? null,
            'name'          => $this->name ?? null,
            'email'         => $this->email ?? null,
            'user_image'    => $this->user_image_id ? asset('/images/'. $this->user_image->name) : null,
            'created_at'    => $this->created_at ? $this->created_at->format('Y-m-d') : null,
        ];
    }
}
