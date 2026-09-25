<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['preferred_date'];

    protected $casts = [
        'reference_paths' => 'array',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class)->withTrashed();
    }

    public function tattooStyle()
    {
        return $this->belongsTo(TattooStyle::class)->withTrashed();
    }

    public function handler()
    {
        return $this->belongsTo(\App\User::class, 'handled_by');
    }

    /** CI-20260923-0001 — số thứ tự chạy lại mỗi ngày. */
    public static function nextCode($prefix = 'CI')
    {
        $day = now()->format('Ymd');

        $count = DB::table('bookings')
            ->where('code', 'like', $prefix.'-'.$day.'-%')
            ->count();

        return sprintf('%s-%s-%04d', $prefix, $day, $count + 1);
    }

    public function scopeStatus(Builder $q, $status)
    {
        return $q->where('status', $status);
    }
}
