<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    // 役職
    /**
     * ユーザーを取得
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
