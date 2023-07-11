<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    function index() {
        return view('frontend.index', [
            'products' => Product::latest()->get(),
            'categories' => Category::all()
        ]);
    }
    function product_details($id) {
        // $available_sizes = Inventory::select('size_id')->where('product_id', $id)->groupBy('size_id')->get();
        // $product = Product::find($id);
        $product = Product::findOrfail($id);
        $related_products = Product::where('category_id', '=', $product->category_id)->where('id', '!=', $id)->get();
        return view('frontend.product_details', compact('product', 'related_products'));
    }
    function cart() {
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.cart', compact('carts'));
    }
    function checkout() {
        $after_explode = explode('/', url()->previous());
        if(end($after_explode) == 'cart'){
            // return "This is proceed to checkout page";
            return view('frontend.checkout');
        }else{
            abort(404);
        }
    }
    function about() {
        return view('frontend.about');
    }
    function contact() {
        return view('frontend.contact');
    }
    function contact_post(Request $request) {

        Mail::to('rahomatulla23siddiki@gmail.com')->send(new ContactMessage($request->except('_token')));
        return back();
    }
    function team(){
        // $teams = Team::latest()->limit(3)->get();
        // $teams = Team::all();
        // $teams = Team::simplePaginate(5);
        $teams = Team::paginate(5);
        $teams_count = Team::count();
        $deleted_teams = Team::onlyTrashed()->get();
        return view('team', compact('teams', 'teams_count', 'deleted_teams'));
    }
    function teaminsert(Request $request){
        //validation
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
        ],[
            'name.required' => 'নাম দেশ নাই কেন ?',
            'phone_number.required' => 'ফোন নাম্বার কই ?'
        ]);
        Team::insert([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'created_at' => Carbon::now()
        ]);
        return back()->with('success_message', 'Team member added successfully');
    }
    function teamdelete($id){
        if ($id == "all") {
            // Team::truncate();
            Team::where('deleted_at', NULL)->delete();
            return back()->with('info_message', 'All Team member deleted');
        } else {
            Team::find($id)->delete();
        }

        return back()->with('info_message', 'Team member deleted successfully');
    }
    function teamedit($id){

        $team = Team::find($id);
        return view('teamedit', [
            'team' => $team
        ]);
        // return view('teamedit')->with('team', $team);
        // return view('teamedit', compact('team'));
    }
    function teameditpost(Request $request, $id){

        Team::find($id)->update([
           'name' => $request->name,
           'phone_number' => $request->phone_number
        ]);
        return redirect('team');
    }
    function teamrestore($id){

        Team::onlyTrashed()
            ->where('id', $id)
            ->restore();
        return redirect('team');
    }
}
