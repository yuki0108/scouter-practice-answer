<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reservation;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingRoom extends Model
{
    // 会議室
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * 任意の会議室での予約を取得
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
