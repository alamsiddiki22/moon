<?php

namespace App\Http\Livewire\Cart;

use App\Models\Cart;
use Livewire\Component;

class Show extends Component
{
    public function cart_delete($id)
    {
        Cart::find($id)->delete();
    }
    public function render()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('livewire.cart.show', compact('carts'));
    }
}
