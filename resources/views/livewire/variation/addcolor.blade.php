<div>
    <div>
        {{-- The Master doesn't talk, he acts. --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Variation Color</h4>
            </div>
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="basic-form">

                    {{-- <form wire:submit.prevent="submit"> --}}
                    <form wire:submit.prevent="insert_color">
                        <div class="mb-3">
                            <label for="" class="form-label">Variation Color Name</label>
                            <input type="text" class="form-control" id="" wire:model="color_name" placeholder="Color">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Variation Color Code</label>
                            <input type="color" class="" id="" wire:model="color_code" placeholder="Color">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-success">Add Color Variation</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th>Color Name</th>
                                    <th>Code Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $color)
                                    <tr>
                                        <td>{{ $color->color_name }}</td>
                                        <td>
                                            <span class="badge" style="background: {{ $color->color_code }}">{{ $color->color_code }}</span>
                                        </td>
                                        <td>
                                            <button wire:click="delete_color({{ $color->id }})" class="btn btn-danger btn-sm">Delete</button>
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
