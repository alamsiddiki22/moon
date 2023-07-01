@extends('layouts.dashboardmaster')
@section('contant')
<div class="page-titles">
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Inventory</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add product - {{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('product.add.inventory.post', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="md-4">
                                <label for="" class="form-label">Add color</label>
                                <select class="form-control" name="color_id" id="">
                                    <option value="">-select one Add Color-</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md-4">
                                <label for="" class="form-label">Add Size</label>
                                <select class="form-control" name="size_id" id="">
                                    <option value="">-select one Add Size-</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md-4 my-4">
                                <label for="" class="form-label">Quantity</label>
                                <input name="quantity" type="text" class="form-control" value="">
                            </div>

                            <div class="md-4">
                                <button type="submit" class="btn btn-info btn-sm">Add Inventory</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Inventory - {{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Inventory Color</th>
                                    <th>Inventory Size</th>
                                    <th>Quantity</th>
                                    <th>Resale Value</th>
                                    <th>Create at</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_resale_value = 0;
                                @endphp
                                @forelse ($inventories as $inventory)
                                    <tr class="@if ($loop->odd) table-primary @else table-danger @endif">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>
                                            {{ App\Models\Color::find($inventory->color_id)->color_name }} ({{ App\Models\Color::find($inventory->color_id)->color_code }})
                                        </td>
                                        <td>{{ App\Models\Size::find($inventory->size_id)->size }}</td>
                                        <td>{{ $inventory->quantity }}</td>
                                        <td>{{ $inventory->quantity * $product->purchase_price }} tk</td>
                                        <td>{{ $inventory->created_at }}</td>
                                        @php
                                            $total_resale_value += ($inventory->quantity * $product->purchase_price);
                                        @endphp
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-danger" colspan="50">No data to show</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">Total</th>
                                    <th>{{ $total_resale_value }}</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
