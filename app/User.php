<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Tài khoản quản trị.
 *
 * Đăng nhập bằng Google OAuth (xem LoginController) nên cột password để trống —
 * tạo user ở admin chỉ là thêm email vào danh sách được phép vào.
 *
 * role  admin  = toàn quyền, thêm được cả quyền vào mục "Quản lý User"
 *       editor = dùng được các mục còn lại trong admin
 * stat  1 = được phép đăng nhập, 0 = chặn (LoginController lọc where stat = 1)
 */
class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN  = 'admin';
    const ROLE_EDITOR = 'editor';

    /** Nhãn tiếng Việt của role, dùng chung cho ô chọn và bảng danh sách. */
    public static $roles = [
        self::ROLE_ADMIN  => 'Quản trị (admin)',
        self::ROLE_EDITOR => 'Biên tập (editor)',
    ];

    protected $fillable = [
        'full_name', 'email', 'phone', 'password', 'role', 'stat',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login'        => 'datetime',
        'stat'              => 'integer',
    ];

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /** Được phép đăng nhập hay không. */
    public function isActive()
    {
        return (int) $this->stat === 1;
    }

    public function getRoleLabelAttribute()
    {
        return static::$roles[$this->role] ?? $this->role;
    }
}
