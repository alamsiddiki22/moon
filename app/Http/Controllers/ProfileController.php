<?php

namespace App\Http\Controllers;
use App\Models\Team;
use App\Models\User;
use App\Models\Verification;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
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

    public function profile()
    {
        if(Verification::where('user_id', auth()->id())->exists()){
            if(Verification::where('user_id', auth()->id())->first()->status){
                $verification_status = true;
            }
            else{
                $verification_status = false;
            }
        }
        else{
            $verification_status = false;
        }
        return view('dashboard.profile.index', compact('verification_status'));
    }
    public function profile_photo_update(Request $request)
    {
        $request->validate([
            // 'profile_photo' => 'required|image',
            'profile_photo' => 'image',
            'cover_photo' => 'image',
        ]);
        if($request->hasFile('profile_photo')){
            $extension = $request->file('profile_photo')->getClientOriginalExtension();
            $new_name = auth()->user()->name."_".auth()->id()."_".Carbon::now()->format('Y_m_d').".".$extension;
            $img = Image::make($request->file('profile_photo'))->resize(300, 200);
            $img->save(base_path('public/uploads/profile_photos/'.$new_name), 80);

            User::find(auth()->id())->update([
                'profile_photo' => $new_name
            ]);
        }
        if($request->hasFile('cover_photo')){
            $extension = $request->file('cover_photo')->getClientOriginalExtension();
            $new_name = auth()->user()->name."_".auth()->id()."_".Carbon::now()->format('Y_m_d').".".$extension;
            $img = Image::make($request->file('cover_photo'))->resize(1600, 450);
            $img->save(base_path('public/uploads/cover_photos/'.$new_name), 80);

            User::find(auth()->id())->update([
                'cover_photo' => $new_name
            ]);
        }

        return back();
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8|different:current_password',
            'password_confirmation' => 'required',
        ]);
        if(Hash::check($request->current_password, auth()->user()->password)){

            User::find(auth()->id())->update([
                'password' => bcrypt($request->password)
            ]);
            return back()->with('success', 'New password set successfully!');
        }
        else{
            return back()->withErrors('Your provided current password does not matched!');
        }

    }
    public function send_veryfication_code()
    {
        // auth()->user()->phone_number;
        $code = rand(1111, 9999);
        // $random = Str::random(40);
        // $random = Str::upper(Str::random(40));
        Verification::insert([
            // 'user_id' => auth()->id(),
            // 'phone_number' => auth()->user()->phone_number,
            // 'code' => $code,
            // 'created_at' => Carbon::now(),

            'user_id' => auth()->id(),
            // 'phone_number' => auth()->user()->phone_number,
            'phone_number' => 01733760416,
            'code' => rand(1111, 9999),
            // 'phone_number' => $number,
            // 'code' => $code,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('code_success', 'A four digit code sent to your mobile number');
    }
    public function check_code(Request $request)
    {
        // echo $request->code;
        // echo Verification::where('user_id', auth()->id())->first()->code;
        if($request->code == Verification::where('user_id', auth()->id())->first()->code){
            Verification::where('user_id', auth()->id())->update([
                'status' => true
            ]);
            return back();
        }else{
            echo "code mile nai";
        }

    }
}
