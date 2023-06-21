{{-- @extends('layouts.master') --}}
@extends('layouts.dashboardmaster')
@section('contant')
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h2>Team Member List
                        <span class="badge bg-success">Total :{{ $teams_count }}</span>
                        <span class="badge bg-warning">This page :{{ $teams->count() }}</span>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Recycle Been
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal Recycle</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Team Name</th>
                                        {{-- <th>Phone Number</th> --}}
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($deleted_teams as $deleted_team)

                                        <tr class="@if ($loop->odd) table-primary @else table-danger @endif">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $deleted_team->name }}</td>
                                        {{-- <td>{{ $deleted_team->phone_number }}</td> --}}
                                        <td>
                                            <a href="{{ url('team/restore') }}/{{ $deleted_team->id }}" class="btn btn-info btn-sm">Undo</a>
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
                    </h2>
                </div>
                <div class="card-body">
                    @if(session('info_message'))
                    <div class="alert alert-warning">
                        {{ session('info_message') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Team Name</th>
                            <th>Team Phone Number</th>
                            <th>Team Create at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($teams as $team)

                            <tr class="@if ($loop->odd) table-primary @else table-danger @endif">
                            <td>{{ $teams->firstitem() + $loop->index }}</td>
                            {{-- <td>{{ $loop->index+1 }}</td> --}}
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->phone_number }}</td>
                            <td>{{ $team->created_at->diffForHumans() }}</td>
                            {{-- <td>{{ $team->created_at->diffForHumans() }}</td> --}}
                            <td>
                                <a href="{{ url('team/delete') }}/{{ $team->id }}" class="btn btn-danger btn-sm">Delete</a>
                                <a href="{{ url('team/edit') }}/{{ $team->id }}" class="btn btn-info btn-sm">Edit</a>
                                {{-- <a href="{{ url('team/edit') }}/{{ $team->id }}" class="btn btn-info btn-sm">Edit Model</a> --}}
                                <!-- Vertically centered modal -->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $team->id }}">
                                Edit-Model
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $team->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('team/edit/post') }}/{{ $team->id }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="" class="form-label">Team Member Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $team->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Team Member Phone Number</label>
                                            <input type="tel" class="form-control" name="phone_number" value="{{ $team->phone_number }}">
                                        </div>
                                        {{-- <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Team Update</button>
                                        </div> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </td>
                            </tr>
                        @endforeach
                            @if($teams->count() == 0)
                            <tr class="text-center text-danger">
                            <td colspan="50">No data to show</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <a href="{{ url('team/delete') }}/all" class="btn btn-warning btn-sm">Delete All</a>
                    {{ $teams->links() }}
                    </div>

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h2>Add Team Member</h2>
                </div>
                <div class="card-body">
                    {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </div>
                    @endif --}}
                    @if(session('success_message'))
                    <div class="alert alert-success">
                        {{ session('success_message') }}
                    </div>
                    @endif
                    <form action="{{ url('team/insert') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Team Member Name</label>
                        <input type="text" class="@if(old('name')) is-valid @endif form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Team Member Phone Number</label>
                        <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="phone_number">
                        @error('phone_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Team Member</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_contant')
team page-All right reserved 2023!
@endsection

