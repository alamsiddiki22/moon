<?php

namespace App\Http\Livewire\Variation;

use App\Models\Color;
use Carbon\Carbon;
use Livewire\Component;

class Addcolor extends Component
{
    public $color_name;
    public $color_code;

    public function insert_color(){
        Color::insert([
            'color_name' => $this->color_name,
            'color_code' => $this->color_code,
            'user_id' => auth()->id(),
            'created_at' => Carbon::now()
        ]);
        $this->reset(['color_name', 'color_code']);
        session()->flash('success', 'Color successfully added.');
    }
    // public function delete_size($id){
    //     Color::find($id)->delete();
    // }
    public function render()
    {
        $colors = Color::where('user_id', auth()->id())->latest()->get();
        return view('livewire.variation.addcolor', compact('colors'));
    }
}
