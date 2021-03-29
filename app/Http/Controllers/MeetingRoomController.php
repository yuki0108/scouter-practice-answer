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
    public function index(Request $request)
    {
        if (Auth::user()->is_administrator) {
            // 管理者の場合
            $meetingRooms = MeetingRoom::get();
            return view('meeting_room_index',
                [
                    'meetingRooms' => $meetingRooms
                ]);

        } else {
            // 一般ユーザーの場合
            return redirect('/');
        }
    }

    public function create(){
        if (Auth::user()->is_administrator) {
            // 管理者の場合
            return view('meeting_room_create',
                [
                    'meetingRooms' => MeetingRoom::get(),
                    'items' => Item::get(),
                ]);
        } else {
            // 一般ユーザーの場合
            return redirect('/');
        }
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
    public function edit(Request $request)
    {
        if (Auth::user()->is_administrator) {
            // 管理者の場合
            $meetingRoom = MeetingRoom::find($request->id);
            return view('meeting_room_edit',
                [
                    'room' => $meetingRoom,
                ]);
        } else {
            // 一般ユーザーの場合
            return redirect('/');
        }
    }

    /**
     * 予約の更新
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
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

            MeetingRoom::where('id', $request->id)
                ->update(['id' => $request->id,
                    'name' => $request->name,
                    'max_use_hour' => $request->max_use_hour,
                    'needs_approval' => $request->needs_approval]);
        }

        return redirect(route('rooms.index'));
    }

    /**
     * 予約の削除
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {
        if (Auth::user()->is_administrator) {
            // 管理者の場合
            $room = MeetingRoom::find($request->id);
            $room->delete();

            // 削除した会議室の予約も削除
            $reservations = Reservation::where('meeting_room_id', $request->id);
            $reservations->delete();
        }
        return redirect(route('rooms.index'));
    }
}
