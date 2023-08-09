@extends('layouts.dashboardmaster')
@section('contant')
<div class="page-titles">
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Order List</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order List</h4>
                </div>
                <div class="card-body">
                    @section('footer_scripts')
                        @if (session('success'))
                            <script>
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
                                        <th>Order No</th>
                                        <th>Customer Name</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Order Status</th>
                                        <th>Order Total</th>
                                        <th>Create at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->customer_name }}</td>
                                            <td>{{ $invoice->payment_method }}</td>
                                            <td>{{ $invoice->payment_status }}</td>
                                            <td>{{ $invoice->order_status }}</td>
                                            <td>{{ $invoice->order_total }}</td>
                                            <td>{{ $invoice->created_at->diffForHumans() }}</td>
                                            <td>
                                                {{-- @if ($invoice->order_status != 'delivered') --}}
                                                    <form action="{{ route('vendor.order.status.change', $invoice->id) }}" method="post">
                                                        @csrf
                                                        <select onchange="this.form.submit()" name="order_status">
                                                            <option value="">-Change Order Status-</option>
                                                            <option {{ ($invoice->order_status == 'packaging') ? 'selected':'' }} value="packaging">Packaging</option>
                                                            <option {{ ($invoice->order_status == 'shipping') ? 'selected':'' }} value="shipping">Shipping</option>
                                                            <option {{ ($invoice->order_status == 'delivered') ? 'selected':'' }} value="delivered">Delivered</option>
                                                        </select>
                                                    </form>
                                                {{-- @endif --}}
                                            </td>
                                        </tr>
                                        <tr style="background-color: rgb(250, 243, 243)">
                                            <td colspan="50">
                                                <p>Order Details</p>
                                                @foreach ($invoice->invoice_detail as $single_product)
                                                    <h6>{{ $single_product->relationshipwithproduct->name }} ({{ $single_product->unit_price }}) x ({{ $single_product->quantity }}) = {{ $single_product->unit_price * $single_product->quantity }}</h6>
                                                @endforeach
                                                {{-- {{ App\Models\Invoice_detail::where('invoice_id', $invoice->id)->get() }} --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

