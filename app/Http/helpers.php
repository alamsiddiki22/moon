<?php
    use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Review;

    function cart_count(){
        return Cart::where('user_id', auth()->id())->count();
    }
    function cart_total($product_id, $quantity){
        $product = Product::find($product_id);
            if($product->discounted_price){
                $price = $product->discounted_price;
            }else{
                $price = $product->regular_price;
            }
            return $price * $quantity;
    }
    function get_inventory($product_id, $color_id, $size_id){
       return Inventory::where([
            'product_id' => $product_id,
            'color_id' => $color_id,
            'size_id' => $size_id
        ])->first()->quantity;
    }
    function average_rating($product_id){
        if(Review::where('product_id', $product_id)->exists()){
            return round(Review::where('product_id', $product_id)->average('rating'));
        }else{
            return 0;
        }
    }

    // function average_rating($product_id){
    //     if(Review::where('product_id', $product_id)->exists()){
    //         if (Review::where('product_id', $product_id)->average('rating')){
    //             return Review::where('product_id', $product_id)->average('rating');
    //         }
    //         else{
    //             return '<i class="fas fa-star-half-alt"></i>';
    //            return Review::where('product_id', $product_id)->average('rating');
    //         }
    //     }else{
    //         return 0;
    //     }
    // }
?>
