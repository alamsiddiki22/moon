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
    public function increment($id)
    {
        Cart::find($id)->increment('quantity');
    }
    public function decrement($id)
    {
        Cart::find($id)->decrement('quantity');
    }
    public function input_cart_amount($id, $quantity)
    {
        Cart::find($id)->update([
            'quantity' => $quantity
        ]);
    }
    public function render()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('livewire.cart.show', compact('carts'));
    }
}
