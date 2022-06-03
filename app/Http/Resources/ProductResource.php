<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'name'=> $this->name,
            'description' => $this->description,
            'category' => $this->category()->exists()
                ? CategoryResource::make($this->category)
                : ['name' => 'uncategorized'],
            'amount' => $this->amount,
            'price' => $this->price,
            'order_amount' => $this->whenPivotLoaded('order_product', function () {
                return $this->pivot->quantity;
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
