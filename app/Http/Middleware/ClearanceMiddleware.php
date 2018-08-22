<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 管理员具备所有权限
        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) {
            return $next($request);
        }

        // 文章发布权限
        if ($request->is('posts/create')) {
            if (!Auth::user()->hasPermissionTo('Create Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        // 文章编辑权限
        if ($request->is('posts/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        // 文章删除权限
        if ($request->isMethod('Delete')) {
            if (!Auth::user()->hasPermissionTo('Delete Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
