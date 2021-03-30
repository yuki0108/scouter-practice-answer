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
    }

    /**
     * 備品の登録
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
    }
}
