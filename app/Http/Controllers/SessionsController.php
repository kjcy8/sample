<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
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
            // 登录成功
            session()->flash('success', 'welcome back!');
            return redirect()->route('users.show', [Auth::user()]);
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

