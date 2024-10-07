<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('customers', CustomerController::class)->middleware('auth');
Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])->name('customers.forceDestroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/movies', function () {
    return view('movies'); // Thay đổi thành view thực tế của bạn
})->middleware('age.check');

Route::get('/set-age', function () {
    return view('set-age'); // View chứa form nhập độ tuổi
});

Route::post('/set-age', function (Request $request) {
    $request->validate(['age' => 'required|integer']);
    $request->session()->put('age', $request->age);
    return redirect('/');
});


Route::get('/set-role', function () {
    return view('set-role'); // View để nhập vai trò
});

Route::post('/set-role', function (Request $request) {
    $request->validate(['role' => 'required|string']);
    session(['role' => $request->role]); // Lưu vai trò vào session
    return redirect('/'); // Chuyển hướng đến trang chính
});
Route::get('/admin', function () {
    return view('admin'); // Thay đổi thành view thực tế của bạn
})->middleware('role.check:admin'); // Chỉ cho phép admin truy cập

Route::get('/orders', function () {
    return view('orders'); // Thay đổi thành view thực tế của bạn
})->middleware('role.check:admin,nhanvien'); // Cho phép admin và nhân viên truy cập

Route::get('/profile', function () {
    return view('profile'); // Thay đổi thành view thực tế của bạn
})->middleware('role.check:admin,nhanvien,khachhang');
