<?php

namespace App\Http\Controllers;

use App\Item;
use App\Reservation;
use Illuminate\Http\Request;
use App\MeetingRoom;
use Illuminate\Support\Facades\Auth;

class MeetingRoomController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 予約一覧の表示
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    }

    public function create(){
    }

    /**
     * 予約の登録
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (Auth::user()->is_administrator) {
            // 管理者の場合
            $request->validate([
                'name' => 'required|max:255',
                'max_use_hour' => 'nullable|int',
                'needs_approval' => 'required|boolean',
            ],
            [],
            [
                'name' => '会議室名',
            ]);

            $meetingRoom = new MeetingRoom();
            $meetingRoom->name = $request->name;
            $meetingRoom->max_use_hour = $request->max_use_hour;
            $meetingRoom->needs_approval = $request->needs_approval;
            $meetingRoom->save();

            return redirect(route('rooms.index'));
        } else {
            // 一般ユーザーの場合
            return redirect('/');
        }
    }

    /**
     * 予約の編集
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit()
    {
    }

    /**
     * 予約の更新
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update()
    {
    }

    /**
     * 予約の削除
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete()
    {
    }
}
