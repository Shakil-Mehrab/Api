<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'name'=>$this->name,
            'description'=>$this->detail,
            'price'=>$this->price,
            'TotalPrice'=>round((1-($this->discount/100))*$this->price,2),
            'stock'=>$this->stock==0?"No Stock":$this->stock,
            'discount'=>$this->discount,
            'star'=> $this->reviews->count()>0?round($this->reviews->sum('star')/$this->reviews->count()):'No Rating Yet',
            'href'=>[
                'reviews'=>route('reviews.index',$this->id)
            ]
    
           ];
    }
   
}
 