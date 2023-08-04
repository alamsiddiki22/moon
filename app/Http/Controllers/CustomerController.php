<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    public function account() {
        return view('frontend.account');
    }
    public function customer_login(Request $request) {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('home');
        }
        else{
            echo "Your email or password is wrong!";
        }
    }

    public function customer_register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);
        $id = User::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
            'role' => 'customer',
            'created_at' => Carbon::now(),
        ]);
        // $request->validate([
        //     '*' => 'required',//same
        // ]);

        // send email verification mail
        User::find($id)->sendEmailVerificationNotification();
        return back()->with('customer_success', 'Your account created successfully! A verification email send to your mail');
    }
    public function download_invoice($id) {
        $invoice = Invoice::find($id);
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));
        return $pdf->download('invoice('.$id.').pdf');
    }

}
