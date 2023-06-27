<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Variation Size</h4>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="basic-form">

                {{-- <form wire:submit.prevent="submit"> --}}
                <form wire:submit.prevent="insert_size">
                    <div class="mb-3">
                        <label for="" class="form-label">Variation Size</label>
                        <input type="text" class="form-control" id="" wire:model="size" placeholder="size">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-sm btn-success">Add Size Variation</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sizes as $size)
                                <tr>
                                    <td>{{ $size->size }}</td>
                                    <td>
                                        <button wire:click="delete_size({{ $size->id }})" class="btn btn-danger btn-sm">Delete</button>
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
