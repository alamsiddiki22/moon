@extends('layouts.dashboardmaster')
@section('contant')
<div class="page-titles">
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Add</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Add</h4>
                </div>
                <div class="card-body">
                    @section('footer_scripts')
                        @if (session('success'))
                            {{-- <div class="alert alert-success">
                                {{ session('success') }}
                            </div> --}}
                            <script>
                                // Swal.fire({
                                //     title: "{{ session('success') }}",
                                //     text: "You won't be able to revert this!",
                                //     icon: 'warning',
                                //     showCancelButton: true,
                                //     confirmButtonColor: '#3085d6',
                                //     cancelButtonColor: '#d33',
                                //     confirmButtonText: 'Yes, delete it!'
                                // }).then((result) => {
                                //     if (result.isConfirmed) {
                                //         Swal.fire(
                                //         'Deleted!',
                                //         'Your file has been deleted.',
                                //         'success'
                                //         )
                                //     }
                                // })
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })
                                    Toast.fire({
                                    icon: 'success',
                                    title: "{{ session('success') }}"
                                })
                            </script>
                        @endif
                    @endsection

                    <div class="basic-form">
                        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="md-4">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="" name="name">
                            </div>
                            <div class="md-4">
                                <label for="" class="form-label">Category Name</label>
                                <select class="form-control" name="category_id" id="category_dropdown">
                                    <option value="">-select one category-</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md-4">
                                <label for="" class="form-label">Purchase Price</label>
                                <input type="number" class="form-control" id="" name="purchase_price">
                            </div>
                            <div class="md-4">
                                <label for="" class="form-label">Regular Price</label>
                                <input type="number" class="form-control" id="" name="regular_price">
                            </div>
                            <div class="md-4">
                                <label for="" class="form-label">Discounted Price</label>
                                <input type="number" class="form-control" id="" name="discounted_price">
                            </div>
                            <div class="md-4">
                                <label for="" class="form-label">Description</label>
                                <textarea id="summernote" class="form-control" name="description" rows="5"></textarea>
                            </div>
                            <div class="md-4">
                                <label for="" class="form-label">Short Description</label>
                                <textarea class="form-control" name="short_description" rows="5"></textarea>
                            </div>
                            <div class="md-4">
                                <label for="" class="form-label">Additional Information</label>
                                <textarea class="form-control" name="additional_information" rows="5"></textarea>
                            </div>
                            <div class="md-4">
                                <label for="" class="form-label mt-2">Thumbnail</label>
                                <input type="file" class="form-control" id="" name="thumbnail">
                            </div>
                            <div class="md-4">
                                <button type="submit" class="btn btn-success">Product Add</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function() {
        $('#category_dropdown').select2();
    });
    </script>
@endsection
