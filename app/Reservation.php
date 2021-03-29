<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * 予約したユーザーを取得
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * 予約した会議室を取得
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meetingRoom()
    {
    }

    /**
     * 予約した備品を取得
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany('App\Item', 'item_reservations')->withTimestamps();
    }

    /**
     * 会議が終了しているかを取得 (true: 終了)
     * @return Boolean
     */
    public function isCompleted()
    {
        $now = date("Y-m-d H:i:s");
        $isCompleted = ($this->end_time) < $now;
        return $isCompleted;
    }

    /**
     * 次の予約番号を取得
     * (予約番号は 000001 から始まる6桁の通し番号である)
     * @return String
     */
    public function getNextReservationNumber()
    {
        $maxReservationNumber = DB::table('reservations')->max('reservation_number');
        $nextInt = 1 + (int)$maxReservationNumber;
        $nextReservationNumber = str_pad($nextInt, 6, 0, STR_PAD_LEFT);
        return $nextReservationNumber;
    }
}
