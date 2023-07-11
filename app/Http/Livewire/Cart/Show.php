<?php

namespace App\Http\Livewire\Cart;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Shipping;
use Livewire\Component;

class Show extends Component
{
    public $shipping_dropdown;
    public $shipping_id = 0;
    public $coupon_name;
    public $coupon_error;
    public $after_discount_subtotal = 0;


    public function apply_coupon($vendor_id, $subtotal)
    {
        if(!$this->coupon_name){
            $this->coupon_error = "Coupon is required";
            $this->after_discount_subtotal = 0;
            session(['coupon_info' => '']);
        }else{
            $this->coupon_error = "" ;
            if(Coupon::where('coupon_name', $this->coupon_name)->exists()){
                //subtotal
                $coupon = Coupon::where('coupon_name', $this->coupon_name)->first();
                if($coupon->vendor_id != $vendor_id){
                    $this->coupon_error = "Wrong vendor Coupon";
                    $this->after_discount_subtotal = 0;
                    session(['coupon_info' => '']);
                }
                else{
                    if(Coupon::where('coupon_name', $this->coupon_name)->first()->coupon_minimum_value <= $subtotal){

                        session(['coupon_info' => $coupon]);
                        // if($coupon->discount_type == 'flat'){
                        //     $this->after_discount_subtotal = $subtotal-$coupon->coupon_discount_amount;
                        // }else{
                        //     $this->after_discount_subtotal = $subtotal - (($coupon->coupon_discount_amount*$subtotal)/100);
                        // }
                    }else{
                        $short = Coupon::where('coupon_name', $this->coupon_name)->first()->coupon_minimum_value - $subtotal;
                        $this->coupon_error = "Minimum purchase amount is not reached. Short: $short";
                        $this->after_discount_subtotal = 0;
                        session(['coupon_info' => '']);
                    }
                }
            }else{
                $this->coupon_error = "This coupon does not exists";
                $this->after_discount_subtotal = 0;
                session(['coupon_info' => '']);
                $this->coupon_name = "";
            }
        }
    }
    public function UpdatedShippingDropdown($id)
    {
        $this->shipping_id = $id;
        if($id == 0){
            session(['shipping_charge' => 0]);
        }else{
            session(['shipping_charge' => Shipping::findOrfail($id)->charge]);
        }
    }
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
        $shippings = Shipping::all();
        // $shippings = Shipping::where('user_id', auth()->id())->get();
        return view('livewire.cart.show', compact('carts', 'shippings'));
    }
}
