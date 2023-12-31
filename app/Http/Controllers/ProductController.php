<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.product.index', [
            'products' => Product::where('vendor_id', auth()->id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.product.create', [
            'categories' => Category::get(['id', 'category_name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Product::insert($request->except('_token') + [
        //     'vendor_id' => auth()->id(),
        //     'thumbnail' => "hudai",
        // ]);
        $product = Product::create($request->except('_token') + [
            'vendor_id' => auth()->id(),
        ]);

        // photo upload start
        $request->validate([
            // 'profile_photo' => 'required|image',
            'thumbnail' => 'image',
        ]);
        if($request->hasFile('thumbnail')){
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $new_name = $product->id."_".Carbon::now()->format('Y_m_d').".".$extension;
            $img = Image::make($request->file('thumbnail'))->resize(800, 609);
            $img->save(base_path('public/uploads/thumbnails/'.$new_name), 80);

            Product::find($product->id)->update([
                'thumbnail' => $new_name
            ]);
        }
        // photo upload end
        // return back()->with('success', 'product added successfully!');
        return redirect('product')->with('success', 'product added successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function addinventory(Product $product)
    {
        $sizes = Size::where('user_id', auth()->id())->get();
        $colors = Color::where('user_id', auth()->id())->get();
        $inventories = Inventory::where([
            'vendor_id' => auth()->id(),
            'product_id' => $product->id
        ])->get();
        return view('dashboard.product.addinventory', compact('product', 'sizes', 'colors', 'inventories'));
    }
    public function addinventorypost(Product $product, Request $request)
    {
        $inventory = Inventory::where([
            'product_id' => $product->id,
            'vendor_id' => $product->vendor_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
        ])->first();
        if($inventory){
            $inventory->increment('quantity', $request->quantity);
            $inventory->save();
        }else{
            Inventory::insert([
                'product_id' => $product->id,
                'vendor_id' => $product->vendor_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now()
            ]);
        }
        return back();
    }
}
