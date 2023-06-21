<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function vendor_registration()
    {
        return view('frontend.vendor.register');
    }
    public function vendor_login()
    {
        return view('frontend.vendor.login');
    }
    public function vendor_login_post(Request $request)
    {
        if(User::where('email', $request->email)->exists()){
            if(User::where('email', $request->email)->first()->role == 'vendor'){
                if(User::where('email', $request->email)->first()->action == true){
                    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                        return redirect('home');
                    }
                    else{
                        echo "Your email or password is wrong!";
                    }
                }else{
                    echo "Your account is not approved yet!";
                }
            }else{
                echo "You are not a vendor!";
            }
        }else{
            echo "Your email is wrong!";
        }
        // return back();
    }
    public function vendor_registration_post(Request $request)
    {
        //new system
        User::insert($request->except('_token', 'password', 'password_confirmation') + [
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
            'role' => 'vendor',
            'action' => false,
        ]);
        return back();
        //old system
        // User::insert([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'email_verified_at' => Carbon::now(),
        //     'password' => bcrypt($request->password),
        //     'phone_number' => $request->phone_number,
        //     'created_at' => Carbon::now(),
        //     'role' => 'vendor',
        // ]);

    }

}
