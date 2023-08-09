@extends('layouts.frontendmaster')

@section('content')
 <!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>My Account</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->
<style>
*{
    margin: 0;
    padding: 0;
}
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    /* top:-9999px; */
    display: none;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}

/* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
</style>
<!-- account_section - start
================================================== -->
<section class="account_section section_space">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 account_menu">
                <div class="card">
                    <div class="card-header">
                        Give Reviews
                    </div>
                    <div class="card-body">
                        @foreach ($invoice_details as $invoice_detail)
                        @if (!App\Models\Review::where('invoice_details_id', $invoice_detail->id)->exists())
                        <div class="table-responsive">
                            <table class="table table-primary">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <img src="{{ asset('uploads/thumbnails') }}/{{ $invoice_detail->relationshipwithproduct->thumbnail }}" alt="" width="120">
                                        </th>
                                        <th scope="col">Product Name: {{ $invoice_detail->relationshipwithproduct->name }}</th>
                                        <th scope="col">Product Quantity: {{ $invoice_detail->quantity }}</th>
                                        <th scope="col">Product Unit Price: {{ $invoice_detail->unit_price }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                            <form action="{{ route('insert.review', $invoice_detail->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Rating</label>
                                    <br>
                                    <div class="rate">
                                        <input type="radio" id="star5_{{ $invoice_detail->id }}" name="rating" value="5" />
                                        <label for="star5_{{ $invoice_detail->id }}" title="text">5 stars</label>
                                        <input type="radio" id="star4_{{ $invoice_detail->id }}" name="rating" value="4" />
                                        <label for="star4_{{ $invoice_detail->id }}" title="text">4 stars</label>
                                        <input type="radio" id="star3_{{ $invoice_detail->id }}" name="rating" value="3" />
                                        <label for="star3_{{ $invoice_detail->id }}" title="text">3 stars</label>
                                        <input type="radio" id="star2_{{ $invoice_detail->id }}" name="rating" value="2" />
                                        <label for="star2_{{ $invoice_detail->id }}" title="text">2 stars</label>
                                        <input type="radio" id="star1_{{ $invoice_detail->id }}" name="rating" value="1" />
                                        <label for="star1_{{ $invoice_detail->id }}" title="text">1 star</label>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="mb-3">
                                    <label for="" class="form-label">Comment</label>
                                    <textarea class="form-control" name="comments" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Give Rating</button>
                                </div>
                            </form>
                            <hr>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- account_section - end
================================================== -->
@endsection

