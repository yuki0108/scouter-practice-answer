<?php

namespace App\Http\Controllers;

use App\Department;
use App\MeetingRoom;
use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    // ユーザー
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ユーザー一覧/検索
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    }

    /**
     * ユーザーの詳細
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        if (Auth::user()->is_administrator) {
            // 管理者の場合
            $user = User::find($request->id);
            return view('user_show', [
                'user' => $user,
            ]);
        } else {
            // 一般ユーザーの場合
            return redirect('/');
        }
    }


    /**
     * ユーザーの編集
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Request $request)
    {
        if (Auth::user()->is_administrator) {
            // 管理者の場合
            $user = User::find($request->id);
            return view('user_edit',
                [
                    'user' => $user,
                    'departments' => Department::get(),
                    'positions' => Position::get(),
                ]);
        } else {
            // 一般ユーザーの場合
            return redirect('/');
        }
    }

    /**
     * ユーザーの更新
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        if (Auth::user()->is_administrator) {
            // 管理者の場合
            $request->validate([
                'is_administrator' => ['required'],
                'user_name_id' => ['required', 'string', 'max:20'],
                'name' => ['required', 'string', 'max:255'],
                'zipcode' => ['required', 'string', 'regex:/^[0-9]{3}-[0-9]{4}$/'],
                'address' => ['required', 'string', 'max:255'],
                'department_id' => ['required'],
            ]);

            if (Auth::user()->is_administrator
                && Auth::id() == $request->id
                && $request->is_administrator == false) {
                // 自分自身の権限を管理者から一般に変更しようとしたらエラー
                return back()
                    ->withInput()
                    ->with('error', '自分自身を管理者から一般ユーザーに変更することはできません');
            }

            if (User::where('id', '!=', $request->id)->where('user_name_id', $request->user_name_id)->count() > 0) {
                // 自身以外のユーザーIDと重複したらエラー
                return back()
                    ->withInput()
                    ->with('error', 'すでに "' . $request->user_name_id . '" というユーザーIDは利用されています');
            }

            if (User::where('id', '!=', $request->id)->where('email', $request->email)->count() > 0) {
                // 自身以外のユーザーのメールアドレスと重複したらエラー
                return back()
                    ->withInput()
                    ->with('error', 'すでに "' . $request->email . '" というメールアドレスは利用されています');
            }

            // ユーザー情報を更新
            User::where('id', $request->id)
                ->update(['id' => $request->id,
                    'is_administrator' => $request->is_administrator,
                    'user_name_id' => $request->user_name_id,
                    'name' => $request->name,
                    'zipcode' => $request->zipcode,
                    'address' =>$request->address,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'department_id' => $request->department_id,
                    'position_id' => $request->position_id,
                ]);
        }

        return redirect(route('users.index'));
    }
}
