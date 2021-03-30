<?php

namespace App\Http\Controllers;

use App\MeetingRoom;
use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * 備品の新規入力
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(){
        if (Auth::user()->is_administrator) {
            // 管理者の場合
            return view('item_create');
        } else {
            // 一般ユーザーの場合
            return redirect('/');
        }
    }

    /**
     * 備品の登録
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (Auth::user()->is_administrator) {
            // 管理者の場合
            $request->validate([
                'item_name' => 'required|max:255',
            ]);

            $item = new Item();
            $item->name = $request->item_name;
            $item->save();

            return redirect('/');
        } else {
            // 一般ユーザーの場合
            return redirect('/');
        }

    }
}
