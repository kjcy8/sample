<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        // auth
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store','index', 'confirmEmail']
        ]);

        // guest
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /*
     * 创建用户
     *
     */
    public function create()
    {
        return view('users.create');
    }

    /*
     * 显示用户信息
     *
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /*
     * 保存用户信息
     *
     */
    public function store(Request $request)
    {
        // 验证
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        // 入库
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // 发送验证邮件
        $this->sendEmailConfirmationTo($user);

        session()->flash('success', '验证邮件已发送到你的注册邮箱，请注意查收');
        return redirect('/');
    }

    /*
     * 发送邮件
     *
     */
    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'sample@qq.com';
        $name = 'Sample Laravel';
        $to = $user->email;
        $subject = 'Thanks for signing up with Sample! Please confirm your email.';

        Mail::send($view, $data, function($message) use ($from, $name, $to, $subject){
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    /*
     * 确认邮件
     *
     */
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '激活成功!');
        return redirect()->route('users.show', [$user]);
    }

    /*
     * 更新用户信息视图
     *
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /*
     * 更新信息
     *
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success', 'update success');

        return redirect()->route('users.show', $user->id);
    }

    /*
     * 删除
     *
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', 'delete success');
        return back();
    }

}
