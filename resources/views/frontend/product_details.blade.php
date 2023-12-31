@extends('layouts.frontendmaster')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Product Details</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- product_details - start
================================================== -->
<section class="product_details section_space pb-0">
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <div class="product_details_image">
                    <div class="details_image_carousel">
                        <div class="slider_item">
                            {{-- <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_1.png" alt="image_not_found"> --}}
                            @if ($product->thumbnail)
                                <img src="{{ asset('uploads/thumbnails') }}/{{ $product->thumbnail }}" class="img-fluid" alt="">
                            @else
                            {{-- <img height="110px" src="{{ Avatar::create($product->name)->setShape('square') }}" /> --}}
                                <img height="100px" width="156px" src="https://st3.depositphotos.com/23594922/31822/v/1600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" alt="">
                            @endif
                        </div>
                        {{-- <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_2.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_3.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_4.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_1.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_2.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_3.png" alt="image_not_found">
                        </div>--}}
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_4.png" alt="image_not_found">
                        </div>
                    </div>

                    <div class="details_image_carousel_nav">
                        <div class="slider_item">
                            {{-- <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_1.png" alt="image_not_found"> --}}
                            <img src="{{ asset('uploads/thumbnails') }}/{{ $product->thumbnail }}" class="img-fluid" alt="">
                        </div>
                        {{-- <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_2.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_3.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_4.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_1.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_2.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_3.png" alt="image_not_found">
                        </div>--}}
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_4.png" alt="image_not_found">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="product_details_content">
                    <h2 class="item_title">{{ $product->name }}</h2>
                    <p>{{ $product->short_description, 20 }}</p>
                    <div class="item_review">
                        <ul class="rating_star ul_li">
                            <li><i class="fas fa-star"></i>></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star-half-alt"></i></li>
                        </ul>
                        <span class="review_value">3 Rating(s)</span>
                    </div>

                    <div class="item_price">
                        @if ($product->discounted_price)
                            <span>৳ {{ $product->discounted_price }}</span>
                            <del>৳ {{ $product->regular_price }}</del>
                        @else
                            <span>৳ {{ $product->regular_price }}</span>
                        @endif

                    </div>
                    <hr>
                    {{-- <div class="item_attribute">
                        <form action="#">
                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="select_option clearfix">
                                        <h4 class="input_title">Size *</h4>
                                        <select class="form-select">
                                            <option data-display="- Please select -">Choose A Option</option>
                                            @foreach ($available_sizes as $available_size)
                                                <option value="{{ $available_size->relationshipwithsize->id }}">{{ $available_size->relationshipwithsize->size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="select_option clearfix">
                                        <h4 class="input_title">Color *</h4>
                                        <select class="form-select">
                                            <option data-display="- Please select -">Choose A Option</option>
                                            <option value="1">Some option</option>
                                            <option value="2">Another option</option>
                                            <option value="3" disabled>A disabled option</option>
                                            <option value="4">Potato</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="quantity_wrap">
                                <div class="quantity_input">
                                    <button type="button" class="input_number_decrement">
                                        <i class="fal fa-minus"></i>
                                    </button>
                                    <input class="input_number" type="text" value="1">
                                    <button type="button" class="input_number_increment">
                                        <i class="fal fa-plus"></i>
                                    </button>
                                </div>
                                <div class="total_price">
                                    Total:
                                    @if ($product->discounted_price)
                                        <span>৳ {{ $product->discounted_price }}</span>
                                    @else
                                        <span>৳ {{ $product->regular_price }}</span>
                                    @endif
                                </div>
                            </div>

                            <ul class="default_btns_group ul_li">
                                <li><a class="btn btn_primary addtocart_btn" href="#!">Add To Cart</a></li>
                            </ul>
                        </form>
                    </div> --}}

                    @livewire('productdetails.addtocart', ['product_id' => $product->id])
                </div>
            </div>
        </div>

        <div class="details_information_tab">
            <ul class="tabs_nav nav ul_li" role=tablist>
                <li>
                    <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button" role="tab" aria-controls="description_tab" aria-selected="true">
                    Description
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button" role="tab" aria-controls="additional_information_tab" aria-selected="false">
                    Additional information
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab" aria-controls="reviews_tab" aria-selected="false">
                    Reviews(2)
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="description_tab" role="tabpanel">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
                    <p class="mb-0">
                    Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio quis mi. Cras neque metus, consequat et blandit et, luctus a nunc. Etiam gravida vehicula tellus, in imperdiet ligula euismod eget.
                    </p>
                </div>

                <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">
                    <p>
                    Return into stiff sections the bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked what's happened to me he thought It wasn't a dream. His room, a proper human room although a little too small
                    </p>

                    <div class="additional_info_list">
                        <h4 class="info_title">Additional Info</h4>
                        <ul class="ul_li_block">
                            <li>No Side Effects</li>
                            <li>Made in USA</li>
                        </ul>
                    </div>

                    <div class="additional_info_list">
                        <h4 class="info_title">Product Features Info</h4>
                        <ul class="ul_li_block">
                            <li>Compatible for indoor and outdoor use</li>
                            <li>Wide polypropylene shell seat for unrivalled comfort</li>
                            <li>Rust-resistant frame</li>
                            <li>Durable UV and weather-resistant construction</li>
                            <li>Shell seat features water draining recess</li>
                            <li>Shell and base are stackable for transport</li>
                            <li>Choice of monochrome finishes and colourways</li>
                            <li>Designed by Nagi</li>
                        </ul>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                    <div class="average_area">
                        <div class="row align-items-center">
                            <div class="col-md-12 order-last">
                                <div class="average_rating_text">
                                    <ul class="rating_star ul_li_center">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                    <p class="mb-0">
                                    Average Star Rating: <span>4 out of 5</span> (2 vote)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="customer_reviews">
                        <h4 class="reviews_tab_title">2 reviews for this product</h4>
                        <div class="customer_review_item clearfix">
                            <div class="customer_image">
                                <img src="{{ asset('frontend_assets') }}/images/team/team_1.jpg" alt="image_not_found">
                            </div>
                            <div class="customer_content">
                                <div class="customer_info">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <h4 class="customer_name">Aonathor troet</h4>
                                    <span class="comment_date">JUNE 2, 2021</span>
                                </div>
                                <p class="mb-0">Nice Product, I got one in black. Goes with anything!</p>
                            </div>
                        </div>

                        <div class="customer_review_item clearfix">
                            <div class="customer_image">
                                <img src="{{ asset('frontend_assets') }}/images/team/team_2.jpg" alt="image_not_found">
                            </div>
                            <div class="customer_content">
                                <div class="customer_info">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <h4 class="customer_name">Danial obrain</h4>
                                    <span class="comment_date">JUNE 2, 2021</span>
                                </div>
                                <p class="mb-0">
                                Great product quality, Great Design and Great Service.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="customer_review_form">
                        <h4 class="reviews_tab_title">Add a review</h4>
                        <form action="#">
                            <div class="form_item">
                                <input type="text" name="name" placeholder="Your name*">
                            </div>
                            <div class="form_item">
                                <input type="email" name="email" placeholder="Your Email*">
                            </div>
                            <div class="your_ratings">
                                <h5>Your Ratings:</h5>
                                <button type="button"><i class="fa fa-star"></i></button>
                                <button type="button"><i class="fa fa-star"></i></button>
                                <button type="button"><i class="fa fa-star"></i></button>
                                <button type="button"><i class="fa fa-star"></i></button>
                                <button type="button"><i class="fa fa-star"></i></button>
                            </div>
                            <div class="form_item">
                                <textarea name="comment" placeholder="Your Review*"></textarea>
                            </div>
                            <button type="submit" class="btn btn_primary">Submit Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_details - end
================================================== -->

<!-- related_products_section - start
================================================== -->
<section class="related_products_section section_space">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="best-selling-products related-product-area">
                    <div class="sec-title-link">
                        <h3>Related products</h3>
                        <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a></div>
                    </div>
                    <div class="product-area clearfix">
                        @forelse ($related_products as $product)
                        @include('frontend.parts.product.grid')

                        @empty
                        <div class="alert alert-danger">
                            No product to show
                        </div>

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- related_products_section - end
================================================== -->
@endsection
