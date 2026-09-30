<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Chỉ cho user role = admin đi tiếp. Dùng kèm middleware 'auth':
 *
 *     ->middleware(['auth', 'admin'])
 *
 * Chưa đăng nhập thì 'auth' đã đá về trang login trước rồi, nên ở đây chỉ còn
 * trường hợp đã đăng nhập mà không đủ quyền — trả 403 chứ không redirect, để
 * người dùng biết là bị chặn quyền chứ không phải hết phiên.
 */
class EnsureUserIsAdmin
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (! $user || ! $user->isAdmin()) {
            throw new AccessDeniedHttpException('Chỉ tài khoản quản trị (admin) mới vào được mục này.');
        }

        return $next($request);
    }
}
