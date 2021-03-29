<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // ユーザー
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name_id','name', 'zipcode', 'address', 'email', 'department_id', 'is_administrator', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 所属部署を取得
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    /**
     * 役職を取得
     * @return BelongsTo
     */
    public function position()
    {
        return $this->belongsTo('App\Position');
    }
}
