@extends('layouts.dashboardmaster')
@section('contant')
<div class="page-titles">
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">wallet_withdraw</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">wallet_withdraw</h4>
                </div>
                <div class="card-body">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_withdrawl_amount = 0;
                                    @endphp
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->customer_name }}</td>
                                            <td>{{ $invoice->payment_method }}</td>
                                            <td>{{ $invoice->payment_status }}</td>
                                            <td>{{ $invoice->order_status }}</td>
                                            <td>{{ $invoice->order_total }}</td>
                                            <td>{{ ($invoice->order_total * 10/100) }}</td>
                                            <td>{{ floor($invoice->order_total-($invoice->order_total * 10/100)) }}</td>
                                            @php
                                                $total_withdrawl_amount += floor($invoice->order_total-($invoice->order_total * 10/100));
                                            @endphp
                                            <td>{{ $invoice->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="8" class="text-right">
                                            <h2>Total: {{ $total_withdrawl_amount }}</h2>
                                            <form action="{{ route('vendor.wallet.withdrawl.request') }}" method="post">
                                                @csrf
                                                <input type="text" value="{{ $invoices->pluck('id') }}" name="withdrawl_ids">
                                                <button type="submit" class="btn btn-sm btn-success">Send Withdrawl Request</button>
                                            </form>
                                        </td>
                                    </tr>
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

