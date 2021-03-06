<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only' => ['create']
        ]);
    }

    // 登录视图
    public function create()
    {
        return view('sessions.create');
    }

    // 登录验证
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))){
            // 账户是否激活
            if(Auth::user()->activated){
                session()->flash('success', 'welcome back!');
                return redirect()->route('users.show', [Auth::user()]);
            }
            else{
                Auth::logout();
                session()->flash('warning', 'sorry, your account has not yet been activated');
                return redirect()->route('/');
            }
        }
        else{
            // 登录失败
            session()->flash('danger', 'sorry, Incorrect username or password.');
            return redirect()->back();
        }

        return;
    }

    // 退出
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', 'logout!');
        return redirect('login');
    }

}

