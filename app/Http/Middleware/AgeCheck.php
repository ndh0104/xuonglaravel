<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AgeCheck
{
    public function handle(Request $request, Closure $next): mixed
    {
        $age = $request->session()->get('age'); // Lấy độ tuổi từ session

        if (is_null($age) || $age < 18) {
            // Lưu thông báo vào session
            Session::flash('alert', 'Bạn chưa đủ 18 tuổi để truy cập trang này.');
            return redirect('/'); // Chuyển hướng về trang chủ
        }

        return $next($request); // Tiếp tục xử lý request nếu đủ tuổi
    }
}
