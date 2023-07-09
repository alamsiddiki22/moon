@extends('layouts.frontendmaster')

@section('content')

@if (cart_count() == 0)
 <!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="route('index')">Home</a></li>
            <li>Empty Cart</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- empty_cart_section - start
================================================== -->
<section class="empty_cart_section section_space">
    <div class="container">
        <div class="empty_cart_content text-center">
            <span class="cart_icon">
                <i class="icon icon-ShoppingCart"></i>
            </span>
            <h3>There are no more items in your cart</h3>
            <a class="btn btn_secondary" href="index.http"><i class="far fa-chevron-left"></i> Continue shopping </a>
        </div>
    </div>
</section>
<!-- empty_cart_section - end
================================================== -->
@else
@livewire('cart.show')
<!-- breadcrumb_section - start
================================================== -->
{{-- <div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="route('index')">Home</a></li>
            <li>Cart</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->
<!-- cart_section - start
================================================== -->
<section class="cart_section section_space">
    <div class="container">

        <div class="cart_table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($carts as $cart)
                        <tr>
                            <td>
                                <div class="cart_product">

                                    <img src="{{ asset('uploads/thumbnails') }}/{{ $cart->relationshipwithproduct->thumbnail }}" alt="image_not_found">
                                    <h3>
                                        <a href="{{ route('product.details', $cart->product_id) }}">
                                            {{ $cart->relationshipwithproduct->name }} (Color: {{ $cart->relationshipwithcolor->color_name }} Size: {{ $cart->relationshipwithsize->size }})
                                            <br><span class="badge bg-info">{{ $cart->relationshipwithuser->name }}</span>
                                            <br><span class="badge bg-warning">Available Stock: {{ get_inventory($cart->product_id, $cart->color_id, $cart->size_id) }}</span>
                                        </a>
                                    </h3>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="price_text">
                                    @if ($cart->relationshipwithproduct->discounted_price)
                                        <span>৳ {{ $cart->relationshipwithproduct->discounted_price }}</span>
                                        <del>৳ {{ $cart->relationshipwithproduct->regular_price }}</del>
                                    @else
                                        <span>৳ {{ $cart->relationshipwithproduct->regular_price }}</span>
                                    @endif
                                </span>
                            </td>
                            <td class="text-center">
                                <form action="#">
                                    <div class="quantity_input">
                                        <button type="button" class="input_number_decrement">
                                            <i class="fal fa-minus"></i>
                                        </button>
                                        <input class="input_number" type="text" value="{{ $cart->quantity }}" />
                                        <button type="button" class="input_number_increment">
                                            <i class="fal fa-plus"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td class="text-center">
                                <span class="price_text">
                                {{ cart_total($cart->product_id, $cart->quantity) }}
                                @php
                                    $subtotal += cart_total($cart->product_id, $cart->quantity);
                                @endphp
                                </span>
                            </td>
                            <td class="text-center"><button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="cart_btns_wrap">
            <div class="row">
                <div class="col col-lg-6">
                    <form action="#">
                        <div class="coupon_form form_item mb-0">
                            <input type="text" name="coupon" placeholder="Coupon Code...">
                            <button type="submit" class="btn btn_dark">Apply Coupon</button>
                            <div class="info_icon">
                                <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col col-lg-6">
                    <ul class="btns_group ul_li_right">
                        <li><a class="btn border_black" href="#!">Update Cart</a></li>
                        <li><a class="btn btn_dark" href="proceed">Prceed To Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-6">
                <div class="calculate_shipping">
                    <h3 class="wrap_title">Calculate Shipping <span class="icon"><i class="far fa-arrow-up"></i></span></h3>
                    <form action="#">
                        <div class="select_option clearfix">
                            <select>
                                <option value="">Select Your Option</option>
                                <option value="1">Inside City</option>
                                <option value="2">Outside City</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn_primary rounded-pill">Update Total</button>
                    </form>
                </div>
            </div>

            <div class="col col-lg-6">
                <div class="cart_total_table">
                    <h3 class="wrap_title">Cart Totals</h3>
                    <ul class="ul_li_block">
                        <li>
                            <span>Cart Subtotal</span>
                            <span>{{ $subtotal }}</span>
                        </li>
                        <li>
                            <span>Discount (-)</span>
                            <span class="text-danger">$5</span>
                        </li>
                        <li>
                            <span>Delivery Charge (+)</span>
                            <span>$5</span>
                        </li>
                        <li>
                            <span>Order Total</span>
                            <span class="total_price">$57.50</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- cart_section - end
================================================== -->

@endif
@endsection
