<div>
    <div class="item_attribute">
        <form action="#">
            <div class="row">
                <div class="col col-md-6">
                    <div class="select_option clearfix">
                        <h4 class="input_title">Size *</h4>
                        {{-- <h1>{{ $test }}</h1> --}}
                        <select class="form-select" wire:model="size_dropdown">
                            <option data-display="- Please select -">Choose A Option</option>
                            @foreach ($available_sizes as $available_size)
                                <option value="{{ $available_size->relationshipwithsize->id }}">{{ $available_size->relationshipwithsize->size }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="select_option clearfix">
                        <h4 class="input_title">Color *</h4>
                        <select class="form-select" wire:model="color_dropdown">
                            @if ($available_colors)
                                <option data-display="- Please select -">Choose A Color</option>
                                @foreach ($available_colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->relationshipwithcolor->color_name }}</option>
                                @endforeach
                            @else
                                <option data-display="- Please select -">Choose Size First</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            {{-- <div class="quantity_wrap">
                <div class="quantity_input">
                    <button type="button" class="input_number_decrement">
                        <i class="fal fa-minus"></i>
                    </button>
                    <input class="input_number" type="text" value="1">
                    <button type="button" class="input_number_increment">
                        <i class="fal fa-plus"></i>
                    </button>
                </div>
            </div> --}}

                <div class="{{ $visibility }}">
                    <span class="badge bg-danger p-2">
                        <i wire:click="decrement" class="fal fa-minus"></i>
                    </span>
                    <span class="border" style="font-size: 40px; margin: 10px;">{{ $count }}</span>
                    <span class="badge bg-success p-2">
                        <i wire:click="increment" class="fal fa-plus"></i>
                    </span>
                        {{-- 2nd option
                            <button class="btn btn-sm btn-warning" wire:click="decrement"><i class="fal fa-minus"></i></button>
                            <input type="text" name="" value="{{ $count }}">
                            <button class="btn btn-sm btn-success" wire:click="increment"><i class="fal fa-plus"></i></button>
                        --}}
                    </div>
                    @if($total_price == 0)
                        <div class="total_price"> Total: {{ $unit_price }}</div>
                    @else
                        <div class="total_price"> Total: {{ $total_price }}</div>
                    @endif

            <ul class="default_btns_group ul_li">
                <li>
                    @auth
                        <a class="btn btn_primary addtocart_btn {{ $visibility }}" wire:click="addtocartbtn">Add To Cart</a>
                    @else
                        <a class="btn btn_primary addtocart_btn" id="not_logged_in">Add To Cart</a>
                    @endauth
                </li>
                {{-- <li>Available Stock: {{ $stock }}</li> --}}
                <a class="btn btn_secondary">Available Stock: {{ $stock }}</a>
            </ul>
            Show test here: {{ $test }}
        </form>
    </div>
</div>
@section('footer_scripts')
<script>
    $(document).ready(function(){
        $('#not_logged_in').click(function(){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You have to login first',
                footer: '<a href="{{ route('account') }}">Go to login</a>'

            })
        });
    });

</script>
@endsection
