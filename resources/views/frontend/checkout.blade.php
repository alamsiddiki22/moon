
@extends('layouts.frontendmaster')

@section('content')

 <!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="route('index')">Home</a></li>
            <li>Check Out</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<div class="container">
    <div class="row my-5">
        <div class="col-8">
            <div class="card text-start">
                <div class="card-header">
                    <h1>Billing Details</h1>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email_address" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" name="phone_number" value="{{ auth()->user()->phone_number }}">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Country</label>
                                <select name="" id="" class="form-select">
                                    <option value="">- Select Country -</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }} (ID: {{ $country->id }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">City</label>
                                <select name="" id="" class="form-select">
                                    <option value="">- Select City -</option>
                                    @foreach ($regsions as $regsions)
                                        <option value="">{{ $regsions->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Address</label>
                        <textarea name="" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Remarks</label>
                        <textarea name="" rows="4" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-start">
                <div class="card-header">
                    <h1>Your order</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Column 1</th>
                                    <th scope="col">Column 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>R1C2</td>
                                    <td>R1C3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="" class="form-label">Payment Method</label>
                        <select name="" id="" class="form-select">
                            <option value="">- Select Payment Method -</option>
                            <option value="">Cash On Delivery (COD)</option>
                            <option value="">Online Payment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button class="btn bg-info">Order now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- checkout-section - end
================================================== -->

@endsection
@section('footer_scripts')
<script>
    
</script>
@endsection


