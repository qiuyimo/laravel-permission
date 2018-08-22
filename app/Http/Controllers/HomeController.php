<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $allPermissions = $user->permissions;
        dump('获取登录用户的所有权限', $allPermissions);

        $roles = $user->roles()->pluck('name');
        dump('通过 pluck 方法获取用户角色名称', $roles);



        return view('home');
    }
}
