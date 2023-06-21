@extends('layouts.dashboardmaster')
@section('contant')
<div class="page-titles">
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Category Edit</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Category Edit</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="col-md-4">
                                <label for="" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="" name="category_name" value="{{ $category->category_name }}">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Category Link/Slug</label>
                                <input type="text" class="form-control" id="" name="category_slug" value="{{ $category->category_slug }}">
                                <small class="text-info ">Type here if you want to change</small>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label mt-2">Current Category Photo</label>
                                <br>
                                <img width="80" src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" class="img-fluid" alt="">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label mt-2">Category Photo</label>
                                <input type="file" class="form-control" id="" name="category_photo">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-info">Edit Category</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
