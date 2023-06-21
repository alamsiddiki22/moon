@extends('layouts.dashboardmaster')

@section('contant')
{{-- <div class="container-fluid"> --}}
<div>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Admin List</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>SL No</th>
                                      <th>User Name</th>
                                      <th>Email Address</th>
                                      <th>Phone Number</th>
                                      <th>Profile Photo</th>
                                      <th>User Create at</th>
                                      <th>Role</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($users->where('role', 'admin') as $user)

                                      <tr class="@if ($loop->odd) table-primary @else table-danger @endif">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>
                                            @empty($user->profile_photo)
                                                <img height="50px" src="{{ Avatar::create($user->name)->toBase64() }}" />
                                            @else
                                                <img src="{{ asset('uploads/profile_photos') }}/{{ $user->profile_photo }}" alt="" width="120">
                                            @endempty
                                        </td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        {{-- <td>{{ $user->created_at }}</td> --}}
                                        <td>{{ $user->role }}</td>
                                        <td>
                                          <a href="{{ url('user/delete') }}/{{ $user->id }}" class="btn btn-danger btn-sm">Delete</a>
                                          <a href="{{ url('user/edit') }}/{{ $user->id }}" class="btn btn-info btn-sm">Edit</a>
                                          {{-- <a href="{{ url('user/edit') }}/{{ $user->id }}" class="btn btn-info btn-sm">Edit Model</a> --}}

                                        </td>
                                      </tr>
                                    @endforeach
                                     @if($users->count() == 0)
                                      <tr class="text-center text-danger">
                                        <td colspan="50">No data to show</td>
                                      </tr>
                                     @endif
                                  </tbody>
                                </table>
                                <a href="{{ url('user/delete') }}/all" class="btn btn-warning btn-sm">Delete All</a>

                              </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Vendor List</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>SL No</th>
                                      <th>User Name</th>
                                      <th>Email Address</th>
                                      <th>Phone Number</th>
                                      <th>Profile Photo</th>
                                      <th>User Create at</th>
                                      <th>Action</th>
                                      <th>Role</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($users->where('role', 'vendor') as $user)

                                      <tr class="@if ($loop->odd) table-primary @else table-danger @endif">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>
                                            @empty($user->profile_photo)
                                                <img height="50px" src="{{ Avatar::create($user->name)->toBase64() }}" />
                                            @else
                                                <img src="{{ asset('uploads/profile_photos') }}/{{ $user->profile_photo }}" alt="" width="120">
                                            @endempty
                                        </td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        {{-- <td>{{ $user->created_at }}</td> --}}
                                        <td>
                                            {{ ($user->action == true) ? 'active' : 'deactive' }}
                                            <input type="checkbox" id="switch" /><label for="switch">Toggle</label>
                                            {{-- <a href="{{ url('user/delete') }}/{{ $user->id }}" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="{{ url('user/edit') }}/{{ $user->id }}" class="btn btn-info btn-sm">Edit</a> --}}
                                        </td>
                                        <td>{{ $user->role }}</td>
                                      </tr>
                                    @endforeach
                                     @if($users->count() == 0)
                                      <tr class="text-center text-danger">
                                        <td colspan="50">No data to show</td>
                                      </tr>
                                     @endif
                                  </tbody>
                                </table>
                                <a href="{{ url('user/delete') }}/all" class="btn btn-warning btn-sm">Delete All</a>

                              </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Customer List</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>SL No</th>
                                      <th>User Name</th>
                                      <th>Email Address</th>
                                      <th>Phone Number</th>
                                      <th>Profile Photo</th>
                                      <th>User Create at</th>
                                      <th>Role</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($users->where('role', 'customer') as $user)

                                      <tr class="@if ($loop->odd) table-primary @else table-danger @endif">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>
                                            @empty($user->profile_photo)
                                                <img height="50px" src="{{ Avatar::create($user->name)->toBase64() }}" />
                                            @else
                                                <img src="{{ asset('uploads/profile_photos') }}/{{ $user->profile_photo }}" alt="" width="120">
                                            @endempty
                                        </td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        {{-- <td>{{ $user->created_at }}</td> --}}
                                        <td>{{ $user->role }}</td>
                                        <td>
                                          <a href="{{ url('user/delete') }}/{{ $user->id }}" class="btn btn-danger btn-sm">Delete</a>
                                          <a href="{{ url('user/edit') }}/{{ $user->id }}" class="btn btn-info btn-sm">Edit</a>
                                          {{-- <a href="{{ url('user/edit') }}/{{ $user->id }}" class="btn btn-info btn-sm">Edit Model</a> --}}

                                        </td>
                                      </tr>
                                    @endforeach
                                     @if($users->count() == 0)
                                      <tr class="text-center text-danger">
                                        <td colspan="50">No data to show</td>
                                      </tr>
                                     @endif
                                  </tbody>
                                </table>
                                <a href="{{ url('user/delete') }}/all" class="btn btn-warning btn-sm">Delete All</a>

                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4" style="height: 450px;">
            <div class="card">
                <div class="card-header">Users Add</div>

                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            <li>{{ $error }}</li>
                        </div>
                    @endforeach
                <div class="card-body">
                    <form action="{{ route('add.user') }}" method="post">
                        @csrf
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="name">
                        </div>
                        <div class="col-md-12">
                            <label for="" class="form-label">Admin Email</label>
                            <input type="email" class="form-control" id="" name="email_address" placeholder="email address">
                        </div>
                        <div class="col-md-12 my-4">
                            <button type="submit" class="btn btn-success">Create New Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
