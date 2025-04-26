<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 管理者判定のために 'role' カラムを追加
        'is_admin', // is_admin フラグを追加
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string',  // roleをstring型としてキャスト
        'is_admin' => 'boolean', // is_admin を boolean としてキャスト
    ];

    /**
     * 管理者判定メソッド
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        // is_admin カラムが true の場合、管理者と判定
        return $this->is_admin;
    }

    /**
     * ユーザーのカート情報を取得
     *
     * @return HasMany
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
