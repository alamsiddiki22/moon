@extends('layouts.dashboardmaster')
@section('contant')
<div class="page-titles">
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Wallet</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Wallet</h4>
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
                                        <th>Commission (10%)</th>
                                        <th>Net total</th>
                                        <th>Create at</th>
                                        <th>Withdrawl status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <form action="{{ route('vendor.wallet.withdrawl') }}" method="post">
                                    @csrf
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->id }}</td>
                                                <td>{{ $invoice->customer_name }}</td>
                                                <td>{{ $invoice->payment_method }}</td>
                                                <td>{{ $invoice->payment_status }}</td>
                                                <td>{{ $invoice->order_status }}</td>
                                                <td>{{ $invoice->order_total }}</td>
                                                <td>{{ ($invoice->order_total * 10/100) }}</td>
                                                <td>{{ $invoice->order_total-($invoice->order_total * 10/100) }}</td>
                                                <td>{{ $invoice->created_at->diffForHumans() }}</td>
                                                <td>
                                                    {{ $invoice->withdrawl_status }}
                                                </td>
                                                <td>
                                                    @if ($invoice->withdrawl_status == 'not requested yet')
                                                        <input type="checkbox" name="invoices[]" value="{{ $invoice->id }}">
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="50" class="text-right">
                                                <button type="submit" class="btn-sm btn btn-info">Get Paid</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </form>
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

