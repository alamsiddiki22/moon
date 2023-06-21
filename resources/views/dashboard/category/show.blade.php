@extends('layouts.dashboardmaster')
@section('contant')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID NO</th>
                                    <td>{{ $category->id }} id</td>
                                </tr>
                                <tr>
                                    <th>Category Name</th>
                                    <td>{{ $category->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Category Slug</th>
                                    <td>{{ $category->category_slug }}</td>
                                </tr>
                                <tr>
                                    <th>Category Photo</th>
                                    <td>
                                        <img width="80" src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Create at</th>
                                    <td>{{ $category->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
