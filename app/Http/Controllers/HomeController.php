<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Mail\NewAdminMail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->role == 'customer'){
            $invoices = Invoice::where('user_id', auth()->id())->get();
            return view('frontend.customer.dashboard', compact('invoices'));
        }else{
            $team = Team::all();
            return view('home', [
                'teams' => $team,
            ]);
        }

    }
    public function users()
    {
        $user = User::latest()->get();
        // $user = User::all();
        // $user = User::where('role', 'admin')->get();
        return view('users', [
            'users' => $user,
        ]);
    }
    public function add_user(Request $request)
    {
        // return $request;
        $request->validate([
            'email_address'=> 'unique:App\Models\User,email'
        ]);
        $random_password = Str::upper(Str::random(6));
        User::insert([
            'name' => $request->name,
            'email' => $request->email_address,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt($random_password),
            'created_at' =>  Carbon::now(),
            'role' => 'admin',
        ]);
        Mail::to($request->email_address)->send(new NewAdminMail(auth()->user()->name, $request->email_address, $random_password));
        // Mail::to('rahomatulla23siddiki@gmail.com')->send(new AdminMail($request->except('_token')));
        return back();
    }
    public function vendor_action_change($id)
    {
        $user = User::find($id);
        if($user->action == false){
            $user->action = true;
        }else{
            $user->action = false;
        }
        $user->save();
        return back();
    }

}
