<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasTranslations;

    protected $guarded = [];

    protected $translatable = ['question', 'answer'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /** Nhãn nhóm hiển thị ngoài site. Khóa phải khớp FaqController::$groups. */
    public static $groupLabels = [
        'booking'   => ['en' => 'Booking', 'vi' => 'Đặt lịch'],
        'aftercare' => ['en' => 'Aftercare', 'vi' => 'Chăm sóc sau xăm'],
        'pricing'   => ['en' => 'Pricing', 'vi' => 'Giá cả'],
        'general'   => ['en' => 'General', 'vi' => 'Chung'],
    ];

    public function getGroupLabelAttribute()
    {
        $locale = app()->getLocale();

        return static::$groupLabels[$this->group][$locale]
            ?? static::$groupLabels[$this->group]['en']
            ?? $this->group;
    }

    public function scopeActive(Builder $q)
    {
        return $q->where('is_active', true);
    }

    public function scopeOrdered(Builder $q)
    {
        return $q->orderBy('sort_order')->orderBy('id');
    }
}
