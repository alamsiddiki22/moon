<div>





    <!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
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
                <style>
                    .halka_lal{
                        background-color: rgb(238, 124, 124)
                    }
                </style>
                <tbody>
                    @php
                        $subtotal = 0;
                        $error = false;
                    @endphp
                    @foreach ($carts as $cart)
                    @php
                        if(get_inventory($cart->product_id, $cart->color_id, $cart->size_id) < $cart->quantity){
                            $error = true;
                        }
                    @endphp
                        <tr class="{{ (get_inventory($cart->product_id, $cart->color_id, $cart->size_id) < $cart->quantity) ? 'halka_lal':'' }}">
                            <td>
                                <div class="cart_product">

                                    <img src="{{ asset('uploads/thumbnails') }}/{{ $cart->relationshipwithproduct->thumbnail }}" alt="image_not_found">
                                    <h3>
                                        <a href="{{ route('product.details', $cart->product_id) }}">
                                            {{ $cart->relationshipwithproduct->name }} (Color: {{ $cart->relationshipwithcolor->color_name }} Size: {{ $cart->relationshipwithsize->size }})
                                            <br><span class="badge bg-info">{{ $cart->relationshipwithuser->name }}</span>
                                            @if (get_inventory($cart->product_id, $cart->color_id, $cart->size_id) < $cart->quantity)
                                                <br><span class="badge bg-warning">Available Stock: {{ get_inventory($cart->product_id, $cart->color_id, $cart->size_id) }}</span>
                                            @endif
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
                                        <button wire:click="decrement({{ $cart->id }})" type="button" class="input_number_decrement">
                                            <i class="fal fa-minus"></i>
                                        </button>
                                        {{-- <input class="input_number" type="text" value="{{ $cart->quantity }}" /> --}}
                                        <input wire:keyup="input_cart_amount({{ $cart->id }}, $event.target.value)" type="text" value="{{ $cart->quantity }}" />
                                        @if(get_inventory($cart->product_id, $cart->color_id, $cart->size_id) != $cart->quantity)
                                            <button wire:click="increment({{ $cart->id }})" type="button" class="input_number_increment">
                                                <i class="fal fa-plus"></i>
                                            </button>
                                        @endif
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
                            <td class="text-center">
                                <button wire:click="cart_delete({{ $cart->id }})" type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="cart_btns_wrap">
            <div class="row">
                <div class="col col-lg-6">
                    <div class="coupon_form form_item mb-0">
                        <input wire:model="coupon_name" type="text" name="coupon" placeholder="@if (session('coupon_info')) {{ session('coupon_info')->coupon_name }} @else Enter coupon here @endif ">
                        <button wire:click="apply_coupon({{ $carts->first()->vendor_id }}, {{ $subtotal }})" type="button" class="btn btn_dark">Apply Coupon</button>
                        {{-- <div class="info_icon">
                            <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                        </div> --}}
                    </div>
                    <small class="text-danger">{{ $coupon_error }}</small>
                </div>

                <div class="col col-lg-6">
                    <ul class="btns_group ul_li_right">
                        <li><a class="btn border_black" href="#!">Update Cart</a></li>
                        <li>
                            @if ($error)
                                <button class="btn btn_dark" disabled>Error ase</button>
                            @else
                                @if ($shipping_id != 0)
                                    <a href="{{ route('checkout') }}" class="btn btn_dark">Proceed To Checkout</a>
                                @endif
                            @endif
                        </li>
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
                            <div class="row">
                                <div class="col-5">
                                    <select class="form-select" wire:model="shipping_dropdown">
                                        <option value="0">Select Your Option</option>
                                        @foreach ($shippings as $shipping)
                                            <option value="{{ $shipping->id }}">{{ $shipping->shipping_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                            <span class="text-danger">
                                @if (session('coupon_info'))
                                    @if (session('coupon_info')->discount_type == 'flat')
                                        {{ session('coupon_info')->coupon_discount_amount }} ({{ session('coupon_info')->coupon_name }})
                                    @else
                                        {{ session('coupon_info')->coupon_discount_amount }}% ({{ session('coupon_info')->coupon_name }})
                                    @endif
                                @else
                                    0
                                @endif
                                {{-- @if ($after_discount_subtotal==0)
                                    0
                                @else
                                    {{ $subtotal - $after_discount_subtotal }}
                                @endif --}}
                            </span>
                        </li>
                        <li>
                            <span>After Discount</span>
                            <span class="text-danger">
                                @if (session('coupon_info'))
                                    @if (session('coupon_info')->discount_type == 'flat')
                                        {{ round($subtotal - session('coupon_info')->coupon_discount_amount) }}
                                        @php
                                            session(['after_discount' => round($subtotal - session('coupon_info')->coupon_discount_amount)]);
                                        @endphp
                                    @else
                                        {{ round($subtotal - ((session('coupon_info')->coupon_discount_amount*$subtotal)/100)) }}
                                        @php
                                            session(['after_discount' => round($subtotal - ((session('coupon_info')->coupon_discount_amount*$subtotal)/100))]);
                                        @endphp
                                    @endif
                                @else
                                    {{ round($subtotal) }}
                                    @php
                                        session(['after_discount' => round($subtotal)]);
                                    @endphp
                                @endif
                            </span>
                        </li>
                        <li>
                            <span>Delivery Charge (+)</span>
                            <span>{{ session('shipping_charge') ?? 0 }}</span>
                        </li>
                        <li>
                            <span>Order Total</span>
                            <span class="total_price">
                                {{ session('after_discount') + session('shipping_charge') }}
                                @php
                                    session(['order_total' => session('after_discount') + session('shipping_charge')]);
                                @endphp
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- section list - start-->
<!--coupon_info
after_discount
shipping_charge
order_total-->
<!-- section list - end-->

<!-- cart_section - end-->
</div>
