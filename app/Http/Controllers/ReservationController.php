<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\MeetingRoom;
use App\Item;
use App\ItemReservation;

use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // 予約
    /**
     * 予約一覧の表示
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        ;
        return view(
            'reservation_index',
            [
                'reservations' => Reservation::get(),
                'userId' => Auth::id(),
                'isAdmin' => Auth::user()->is_administrator,
            ]
        );
    }

    public function create()
    {
        return view(
            'reservation_create',
            [
                'meetingRooms' => MeetingRoom::get(),
                'items' => Item::get(),
                'isAdmin' => Auth::user()->is_administrator,
            ]
        );
    }


    /**
     * 予約の登録
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'meeting_room_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'title' => 'max:255',
        ]);

        $meetingRoom = MeetingRoom::find($request->meeting_room_id);

        // HTMLの input type="datetime-local" に T が含まれているので置換
        $start_time = str_replace('T', ' ', $request->start_time);
        $end_time = str_replace('T', ' ', $request->end_time);


        $maxUseHour = $meetingRoom->max_use_hour;
        if ($maxUseHour != null) {
            // 利用時間の上限がある場合
            // 入力された会議時間を求める (strtotime は秒に変換するため、3600で割る)
            $inputHour = (strtotime($end_time) - strtotime($start_time)) / 3600;
            if ($inputHour > $maxUseHour) {
                // 会議室の最大使用時間を超えている場合は予約画面に戻る
                return back()
                    ->withInput()
                    ->with('error', '選択した会議室の最大利用時間は' . $meetingRoom->max_use_hour .'時間です');
            }
        }

        // すでに予約されている時間と今回入力した時間が重なっている数を取得
        $overlappingReservation = $meetingRoom->reservations->Where('end_time', '>', $start_time)->Where('start_time', '<', $end_time);

        if ($overlappingReservation->Count() > 0) {
            // 時間が重なっている予約がある場合は予約画面に戻る
            $overlappedStartTime = date_create($overlappingReservation->first()->start_time)->format('Y年m月d日H時i分');
            $overlappedEndTime = date_create($overlappingReservation->first()->end_time)->format('Y年m月d日H時i分');
            return back()
                ->withInput()
                ->with('error', '選択した会議室はすでに' . $overlappedStartTime . 'から' . $overlappedEndTime.'まで予約されています');
        }

        $reservation = new Reservation();
        $reservation->reservation_number = $reservation->getNextReservationNumber();
        $reservation->user_id = Auth::id();
        $reservation->meeting_room_id = $request->meeting_room_id;
        $reservation->start_time = $start_time;
        $reservation->end_time = $end_time;
        $reservation->title = $request->title;
        if ($meetingRoom->needs_approval == false) {
            // 承認の必要のない会議室は承認済にする (必要な場合は null (未承認))
            $reservation->is_approved = true;
        }
        $reservation->save();

        // 備品予約の処理
        $items = $request->items;
        if ($items != null) {
            foreach ($items as $itemId) {
                $itemReservation = new ItemReservation();
                $itemReservation->item_id = $itemId;
                $itemReservation->reservation_id = $reservation->id;
                $itemReservation->save();
            }
        }
        return redirect(route('reservations.index'));
    }

    public function edit(Request $request)
    {
        $reservation = Reservation::find($request->id);
        if (Auth::user()->is_administrator || $reservation->user->id == Auth::id()) {
            // HTMLの input type="datetime-local" で表示するために 半角スペースを T に置換
            $reservation->start_time = str_replace(' ', 'T', $reservation->start_time);
            $reservation->end_time = str_replace(' ', 'T', $reservation->end_time);

            // ログインしているのが管理者の場合、
            // またはログインユーザーが予約したユーザーと同一の場合に編集画面へ遷移
            return view(
                'reservation_edit',
                [
                    'reservation' => $reservation,
                    'meetingRooms' => MeetingRoom::get(),
                    'items' => Item::get(),
                    'isAdmin' => Auth::user()->is_administrator,
                ]
            );
        }
    }

    /**
     * 予約の更新
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $request->validate([
            'meeting_room_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'title' => 'max:255',
        ]);

        $meetingRoom = MeetingRoom::find($request->meeting_room_id);

        // HTMLの input type="datetime-local" に T が含まれているので置換
        $start_time = str_replace('T', ' ', $request->start_time);
        $end_time = str_replace('T', ' ', $request->end_time);

        $maxUseHour = $meetingRoom->max_use_hour;
        if ($maxUseHour != null) {
            // 利用時間の上限がある場合
            // 入力された会議時間を求める (strtotime は秒に変換するため、3600で割る)
            $inputHour = (strtotime($end_time) - strtotime($start_time)) / 3600;
            if ($inputHour > $maxUseHour) {
                // 会議室の最大使用時間を超えている場合は予約画面に戻る
                return back()
                    ->withInput()
                    ->with('error', '選択した会議室の最大利用時間は' . $meetingRoom->max_use_hour .'時間です');
            }
        }

        // すでに予約されている時間と今回入力した時間が重なっている数を取得 (この予約を除く)
        $overlappingReservation = $meetingRoom->reservations->where('id', '!=', $request->id)->Where('end_time', '>', $start_time)->Where('start_time', '<', $end_time);

        if ($overlappingReservation->Count() > 0) {
            // 時間が重なっている予約がある場合は予約画面に戻る
            $overlappedStartTime = date_create($overlappingReservation->first()->start_time)->format('Y年m月d日H時i分');
            $overlappedEndTime = date_create($overlappingReservation->first()->end_time)->format('Y年m月d日H時i分');
            return back()
                ->withInput()
                ->with('error', '選択した会議室はすでに' . $overlappedStartTime . 'から' . $overlappedEndTime.'まで予約されています');
        }

        $reservation =  Reservation::where('id', $request->id)->first();

        $isApproved = null;
        if ($meetingRoom->needs_approval == false) {
            // 承認の必要のない会議室は承認済にする (必要な場合は null (未承認))
            $isApproved = true;
        }

        Reservation::where('id', $request->id)
            ->update(['meeting_room_id' => $request->meeting_room_id,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'title' => $request->title,
                'is_approved' => $isApproved]);

        // 備品の予約を一旦消して登録し直す
        ItemReservation::Where('reservation_id', $request->id)->delete();
        $items = $request->items;
        if ($items != null) {
            foreach ($items as $itemId) {
                $itemReservation = new ItemReservation();
                $itemReservation->item_id = $itemId;
                $itemReservation->reservation_id = $request->id;
                $itemReservation->save();
            }
        }
        return redirect(route('reservations.index'));
    }

    /**
     * 予約の削除
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {
        $reservation = Reservation::find($request->id);
        if (Auth::user()->is_administrator || $reservation->user->id == Auth::id()) {
            // ログインしているのが管理者の場合、
            // またはログインユーザーが予約したユーザーと同一の場合に削除
            $reservation->delete();
        }
        return redirect(route('reservations.index'));
    }

    /**
     * 予約の承認
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function approve(Request $request)
    {
        if (Auth::user()->is_administrator) {
            // ログインしているのが管理者の場合のみ実行
            Reservation::where('id', $request->id)
                ->update(['is_approved' => true]);
        }
        return redirect(route('reservations.index'));
    }

    /**
     * 予約の拒否
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function reject(Request $request)
    {
        if (Auth::user()->is_administrator) {
            // ログインしているのが管理者の場合のみ実行
            Reservation::where('id', $request->id)
                ->update(['is_approved' => false]);
        }
        return redirect(route('reservations.index'));
    }
}
