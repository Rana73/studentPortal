<?php

namespace App\Http\Resources;

use App\Models\Field;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'class' => $this->class,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'custom_fields' => $this->customField()
        ];
    }
    public function customField(){
        $data = Field::where('student_id',$this->id)->get();
        return $data->toArray();
    }
}
