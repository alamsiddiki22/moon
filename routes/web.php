<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('frontend/index');
//     // return view('welcome');
// });

Route::get('/', [FrontendController::class, "index"])->name('index');
Route::get('/about', [FrontendController::class, "about"])->name('about');
Route::get('/contact', [FrontendController::class, "contact"])->name('contact');
Route::post('/contact/post', [FrontendController::class, "contact_post"])->name('contact.post');
Route::get('team', [FrontendController::class, "team"]);
Route::post('team/insert', [FrontendController::class, "teaminsert"]);
Route::get('team/delete/{id}', [FrontendController::class, "teamdelete"]);
Route::get('team/edit/{id}', [FrontendController::class, "teamedit"]);
Route::post('team/edit/post/{id}', [FrontendController::class, "teameditpost"]);
Route::get('team/restore/{id}', [FrontendController::class, "teamrestore"]);

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
Route::get('/users', [HomeController::class, 'users']);
Route::post('/vendor/action/change{id}', [HomeController::class, 'vendor_action_change'])->name('vendor.action.change');
Route::post('/add/user', [HomeController::class, 'add_user'])->name('add.user');

Route::get('/profile', [ProfileController::class, 'profile']);
Route::post('/profile/photo/update', [ProfileController::class, 'profile_photo_update']);
Route::post('/change/password', [ProfileController::class, 'change_password']);
Route::get('/send/veryfication/code', [ProfileController::class, 'send_veryfication_code']);
Route::post('/check/code', [ProfileController::class, 'check_code']);

Route::get('/account', [CustomerController::class, 'account'])->name('account');
Route::post('/customer/login', [CustomerController::class, 'customer_login'])->name('customer.login');
Route::post('/customer/register', [CustomerController::class, 'customer_register'])->name('customer.register');

// CategoryController
Route::resource('category', CategoryController::class);

//***email veryfication start***//
//***email veryfication start***//
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//email veryfication end


Route::get('/vendor/registration', [VendorController::class, 'vendor_registration'])->name('vendor.registration');
Route::get('/vendor/login', [VendorController::class, 'vendor_login'])->name('vendor.login');
Route::post('/vendor/registration', [VendorController::class, 'vendor_registration_post'])->name('vendor.registration.post');
Route::post('/vendor/login/post', [VendorController::class, 'vendor_login_post'])->name('vendor.login.post');

