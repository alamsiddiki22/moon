<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        return view('dashboard.category.index', [
            'categories' => Category::all()

            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->category_slug){
            $slug = Str::slug($request->category_slug);
        }else{
            $slug = Str::slug($request->category_name);
        }
        // photo upload start
        $request->validate([
            'category_photo' => 'required|image',
        ]);
        $extension = $request->file('category_photo')->getClientOriginalExtension();
        $new_name = $request->category_name. time()."_".Carbon::now()->format('Y_m_d').".".$extension;
        $img = Image::make($request->file('category_photo'))->resize(300, 200);
        $img->save(base_path('public/uploads/category_photos/'.$new_name), 80);

        // photo upload end

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'category_photo' => $new_name,
            'category_color' => $request->category_color,
            'created_at' => Carbon::now(),
        ]);
        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('dashboard.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Category::find($id)->update([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug
        ]);
        if($request->hasFile('category_photo')){
            unlink(base_path('public/uploads/category_photos/'. Category::find($id)->category_photo));

            //photo upload start
            $extension = $request->file('category_photo')->getClientOriginalExtension();
            $new_name = $request->category_name. time()."_".Carbon::now()->format('Y_m_d').".".$extension;
            $img = Image::make($request->file('category_photo'))->resize(300, 200);
            $img->save(base_path('public/uploads/category_photos/'.$new_name), 80);
            //photo upload end
            Category::find($id)->update([
                'category_photo' => $new_name
            ]);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Category $category)
    {
        $category->delete();
        return back();
    }
    //old system ->same to same//
    // public function destroy($id)
    // {
    //     Category::find($id)->delete();
    //     return back();
    // }
}
