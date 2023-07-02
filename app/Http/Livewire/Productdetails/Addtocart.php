<?php

namespace App\Http\Livewire\Productdetails;

use App\Models\Inventory;
use App\Models\Product;
use Livewire\Component;

class Addtocart extends Component
{
    public $product_id;
    public $size_dropdown;
    public $available_colors;

    // public function clickbtn(){
    //     $this->test = "change korse";
    // }
    public function updatedSizeDropdown($size_id){
        // $this->test = "size id- $size_id product id- $this->product_id";
        $this->available_colors = Inventory::where('product_id', $this->product_id)->where('size_id', $size_id)->get();
    }

    public function render()
    {
        $available_sizes = Inventory::select('size_id')->where('product_id', $this->product_id)->groupBy('size_id')->get();
        return view('livewire.productdetails.addtocart', compact('available_sizes'));
    }
}
