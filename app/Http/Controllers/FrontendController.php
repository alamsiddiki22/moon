<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Invoice_detail;
use App\Models\Product;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Khsing\World\Models\Country;
use Khsing\World\World;

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
            $countries = World::Countries();
            return view('frontend.checkout', compact('countries'));
        }else{
            abort(404);
        }
    }
    function getcitylist(Request $request) {

        $country = Country::getByCode($request->country_code);
        $cities_from_db = $country->children();
        $sorted = collect($cities_from_db)->sortBy('name');
        $cities = $sorted->values()->all();

        $generated_city_dropdown = "";
        foreach ($cities as $city) {
            $generated_city_dropdown .= "<option value='$city->id'>$city->name</option>";
        }
        return $generated_city_dropdown;
    }
    function checkout_post(Request $request) {

        $invoice_id = Invoice::insertGetId([

            'user_id' => auth()->id(),
            'vendor_id' => Cart::where('user_id', auth()->id())->first()->vendor_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone_number' => $request->customer_phone_number,
            'customer_country_id' => $request->customer_country_id,
            'customer_city_id' => $request->customer_city_id,
            'customer_address' => $request->customer_address,
            'customer_remarks' => $request->customer_remarks,
            'payment_method' => $request->payment_method,
            'coupon_info' => session('coupon_info')->coupon_name,
            'after_discount' => session('after_discount'),
            'shipping_charge' => session('shipping_charge'),
            'order_total' => session('order_total'),
            'created_at' => Carbon::now()
        ]);
        // session(['invoice_id', $invoice_id]);
        foreach (Cart::where('user_id', auth()->id())->get() as $cart) {

            if(Product::find($cart->product_id)->discounted_price){
                $unit_price = Product::find($cart->product_id)->discounted_price;
            }else{
                $unit_price = Product::find($cart->product_id)->regular_price;
            }
            echo "<br><br><br><br><br>";

            Invoice_detail::insert([
                'invoice_id' => $invoice_id,
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
                'quantity' => $cart->quantity,
                'unit_price' => $unit_price,
                'created_at' => Carbon::now()
            ]);
            Inventory::where([
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id
            ])->decrement('quantity', $cart->quantity);

            $cart->delete();
        }

        if($request->payment_method == 'cod'){
            return redirect('cart');
        }else{
            // session(['invoice_id', $invoice_id]);
            return redirect('pay')->with('invoice_id', $invoice_id);
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
