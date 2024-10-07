<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (!Auth::check()) {
            return redirect('/login'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
        }

        // Lấy vai trò từ session
        $userRole = session('role'); // Lấy vai trò từ session

        // Kiểm tra quyền truy cập dựa trên vai trò
        if (in_array($userRole, $roles)) {
            return $next($request); // Nếu vai trò hợp lệ, tiếp tục xử lý yêu cầu
        }

        // Nếu vai trò không hợp lệ, chuyển hướng về trang chủ với thông báo
        return redirect('/')->with('alert', 'Bạn không có quyền truy cập vào trang này.');
    }
}
