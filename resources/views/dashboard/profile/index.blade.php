@extends('layouts.dashboardmaster')
@section('contant')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="photo-content">
                        {{-- <div class="cover-photo" style="background: url('{{ asset('uploads/cover_photos') }}/{{ auth()->user()->cover_photo }}'); background-size:cover background-position:center"></div> --}}
                        <div class="cover-photo">
                            @if (auth()->user()->cover_photo)
                                <img src="{{ asset('uploads/cover_photos') }}/{{ auth()->user()->cover_photo }}" class="img-fluid" alt="">
                            @else
                                <img src="{{ asset('dashboard_assets/images/profile/cover.jpg') }}" class="img-fluid" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-photo">
                            @if (auth()->user()->profile_photo)
                                <img src="{{ asset('uploads/profile_photos') }}/{{ auth()->user()->profile_photo }}" class="img-fluid rounded-circle" alt="">
                            @else
                            <img src="{{ Avatar::create(auth()->user()->name )->toBase64() }}" />
                                {{-- <img src="{{ asset('dashboard_assets/images/default_profile_photo.png') }}" class="img-fluid rounded-circle" alt=""> --}}
                            @endif
                        </div>
                        <div class="profile-details">
                            <img height="50px" src="{{ Avatar::create(auth()->user()->name )->toBase64() }}" />
                            <h1>{{ Str::substr(auth()->user()->name, 0, 1) }}</h1>
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{ auth()->user()->name }}</h4>
                                <p>Name</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">{{ auth()->user()->email }}</h4>
                                <p>Email</p>
                            </div>
                            <div class="dropdown ml-auto">
                                <a href="#" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item"><i class="fa fa-user-circle text-primary mr-2"></i> View profile</li>
                                    <li class="dropdown-item"><i class="fa fa-users text-primary mr-2"></i> Add to close friends</li>
                                    <li class="dropdown-item"><i class="fa fa-plus text-primary mr-2"></i> Add to group</li>
                                    <li class="dropdown-item"><i class="fa fa-ban text-primary mr-2"></i> Block</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile Edit</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ url('profile/photo/update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Profile Photo</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="profile_photo">
                                    @error('profile_photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Cover Photo</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control" name="cover_photo">
                                    @error('profile_photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary">Change Photo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Change Your Password</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                    {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ url('change/password') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Current Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" placeholder="Current Password" name="current_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" placeholder="New Password" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Phone Number</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        @if (session('code_success'))
                            <div class="alert alert-success">
                                    {{ session('code_success') }}
                            </div>
                        @endif
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone Number</label>
                                <div class="col-sm-9">
                                    {{-- <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" value="{{ auth()->user()->phone_number }}"> --}}
                                    <p>{{ auth()->user()->phone_number }}</p>
                                    @if ($verification_status)
                                        <span class="badge bg-success text-white">Verified</span>
                                    @else
                                        <span class="badge bg-info text-white">Unverified</span>
                                    @endif
                                </div>
                            </div>
                            @if(!$verification_status)
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <a href="{{ url('send/veryfication/code') }}" class="btn btn-primary btn-sm">Veryfy Now</a>
                                    </div>
                                </div>
                            @endif

                        <form action="{{ url('check/code') }}" method="post">
                            @csrf
                            @if (session('code_success'))
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Give your code here" name="code">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    </div>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
