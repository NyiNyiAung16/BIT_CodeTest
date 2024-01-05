<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        return [
            'idx' => $this->book_uniq_idx,
            'name' => $this->bookname,
            'content_owner_name' => $this->author->name,
            'publisher_name'=>$this->publisher->name,
            'created_date' => $this->created_timetick
        ];
    }
}
