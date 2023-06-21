@extends('layouts.dashboardmaster')

@section('contant')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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
                              <th>Team Name</th>
                              <th>Team Phone Number</th>
                              {{-- <th>Team Create at</th> --}}
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($teams as $team)

                              <tr class="@if ($loop->odd) table-primary @else table-danger @endif">
                                {{-- <td>{{ $teams->firstitem() + $loop->index }}</td> --}}
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->phone_number }}</td>
                                {{-- <td>{{ $team->created_at->diffForHumans() }}</td> --}}
                                <td>
                                  <a href="{{ url('team/delete') }}/{{ $team->id }}" class="btn btn-danger btn-sm">Delete</a>
                                  <a href="{{ url('team/edit') }}/{{ $team->id }}" class="btn btn-info btn-sm">Edit</a>
                                  {{-- <a href="{{ url('team/edit') }}/{{ $team->id }}" class="btn btn-info btn-sm">Edit Model</a> --}}

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
                        {{-- {{ $teams->links() }} --}}
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
