@extends('layouts.dashboardmaster')
@section('contant')
<div class="page-titles">
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Coupon</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 col-lg-6">
        </div>
        <div class="col-xl-6 col-lg-6">
            <div>
                {{-- The Master doesn't talk, he acts. --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Coupon</h4>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="basic-form">
                            <form action="{{ route('coupon.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Coupon Name</label>
                                    <input type="text" class="form-control" name="coupon_name" value="{{ Str::upper(Str::random(4)) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Coupon Minimum Value</label>
                                    <input type="number" class="form-control" name="coupon_minimum_value" placeholder="Coupon">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Discount type</label>
                                    <select name="discount_type" class="form-control" id="">
                                        <option value="percentage">Percentage (%)</option>
                                        <option value="flat">Flat Discount</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Coupon Discount Amount</label>
                                    <input type="number" class="form-control" name="coupon_discount_amount" placeholder="Coupon">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-success">Add Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

