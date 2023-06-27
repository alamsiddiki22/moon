@extends('layouts.dashboardmaster')
@section('contant')
<div class="page-titles">
    <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li> --}}
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Variation</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            @livewire('variation.addsize')
        </div>
    </div>
</div>
@endsection
