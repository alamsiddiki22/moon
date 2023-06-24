@extends('layouts.dashboardmaster')
@section('contant')
<div class="page-titles">
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Product List</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product List</h4>
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="Product_table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Product Photo</th>
                                        <th>Cagegory Name</th>
                                        <th>Create at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr class="@if ($loop->odd) table-primary @else table-danger @endif">
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                @empty($product->thumbnail)
                                                {{-- <img height="110px" src="{{ Avatar::create($product->name)->setShape('square') }}" /> --}}
                                                    <img height="110px" src="https://st3.depositphotos.com/23594922/31822/v/1600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" alt="">
                                                @else
                                                    <img src="{{ asset('uploads/thumbnails') }}/{{ $product->thumbnail }}" alt="" width="120">
                                                @endempty
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    {{ $product->relationshipwithcategory->category_name }}
                                                    {{-- {{ App\Models\Category::find($product->category_id)['category_name']  }} --}}
                                                </span>
                                            </td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>
                                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-info">Details</a>
                                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm mt-1" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-danger" colspan="50">No data to show</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Product Slug</th>
                                        <th>Product Photo</th>
                                        <th>Create at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr class="@if ($loop->odd) table-primary @else table-danger @endif">
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_slug }}</td>
                                            <td>
                                                <img width="80" src="{{ asset('uploads/product_photos') }}/{{ $product->product_photo }}" class="img-fluid" alt="">

                                            </td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>
                                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-info">Details</a>
                                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm mt-1" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-danger" colspan="50">No data to show</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function () {
            $('#Product_table').DataTable();
        });
    </script>
@endsection

