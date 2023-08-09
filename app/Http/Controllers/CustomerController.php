<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoice_detail;
use App\Models\Review;
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
    public function download_invoice($id)
    {
        $invoice = Invoice::find($id);
        $invoice_details = Invoice_detail::where('invoice_id', $id)->get();
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice', 'invoice_details'));
        return $pdf->download('invoice('.$id.').pdf');
    }
    // public function download_invoice_all($id) {
    //     return $id;
    //     return Invoice::where('user_id', $id)->get();
    //     return Excel::download(new InvoicesExport, 'invoices.xlsx');
    // }
    public function give_review($id) {
        $invoice_details = Invoice_detail::with('relationshipwithproduct')->where('invoice_id', $id)->get();
        return view('frontend.customer.review', compact('invoice_details'));
    }
    public function insert_review(Request $request, $invoice_details_id) {
        Review::insert([
            'user_id' => auth()->id(),
            'product_id' => Invoice_detail::find($invoice_details_id)->product_id,
            'invoice_details_id' => $request->invoice_details_id,
            'rating' => $request->rating,
            'comments' => $request->comments,
            'created_at' => Carbon::now()
        ]);
        return back();
    }

}
