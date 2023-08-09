<div class="grid">
    <div class="product-pic">
        @if ($product->thumbnail)
            <img height="150px" width="195px" src="{{ asset('uploads/thumbnails') }}/{{ $product->thumbnail }}" class="img-fluid" alt="">
        @else
            {{-- <img height="110px" src="{{ Avatar::create($product->name)->setShape('square') }}" /> --}}
            <img height="150px" width="195px" src="https://st3.depositphotos.com/23594922/31822/v/1600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" alt="">
        @endif
        @if ($product->discounted_price)
            <span class="theme-badge-2">{{ round(100 -(($product->discounted_price/$product->regular_price)*100), 2) }}% off</span>
        @endif
        {{-- <img src="{{ asset('frontend_assets') }}/images/shop/product_img_12.png" alt> --}}
        <div class="actions">
            <ul>
                <li>
                    <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                </li>
                <li>
                    <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Shuffle</title> <path d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7"/> <path d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17"/> <path d="M19 4L22 7L19 10"/> <path d="M19 13L22 16L19 19"/> </svg></a>
                </li>
                <li>
                    <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button" tabindex="0"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="details">
        <h4>
            <a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
        </h4>
        {{-- <span class="badge bg-info">{{ $product->relationshipwithcategory->category_name }}</span> --}}
        <span class="badge" style="background: {{ $product->relationshipwithcategory->category_color }}">{{ $product->relationshipwithcategory->category_name }}</span>
        <p>
            <a href="#">{{ Str::limit($product->short_description, 20) }} </a>
        </p>
        <div class="rating">
            {{-- <i class="fas fa-star-half-alt"></i> --}}

            @if(average_rating($product->id) == 0)
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
            @endif
            @for ($i=1; $i<=average_rating($product->id); $i++)
                <i class="fas fa-star"></i>
            @endfor

            @php
                $empty_stars = 5-average_rating($product->id);
            @endphp
            @if ($empty_stars != 5)
                @for ($i=1; $i<=$empty_stars; $i++)
                    <i class="far fa-star"></i>
                @endfor
            @endif

        </div>
        <span class="price">
            @if ($product->discounted_price)
                <ins>
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                            <span class="woocommerce-Price-currencySymbol">৳</span>{{ $product->discounted_price }}
                        </bdi>
                    </span>
                </ins>
                <del aria-hidden="true">
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                            <span class="woocommerce-Price-currencySymbol">৳</span>{{ $product->regular_price }}
                        </bdi>
                    </span>
                </del>
            @else
                <ins aria-hidden="true">
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                            <span class="woocommerce-Price-currencySymbol">৳</span>{{ $product->regular_price }}
                        </bdi>
                    </span>
                </ins>
            @endif
        </span>
        <div class="add-cart-area">
            <button class="add-to-cart">
                <a href="{{ route('product.details', $product->id) }}">
                    Details
                </a>
            </button>
            {{-- <button class="add-to-cart">Add to cart</button> --}}
        </div>
    </div>
</div>
