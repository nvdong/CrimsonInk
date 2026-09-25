<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Một dòng cấu hình. Đọc trong code thì dùng App\Support\Settings
 * (có cache một lần mỗi request) chứ đừng query model này trực tiếp trong view.
 */
class Setting extends Model
{
    protected $guarded = [];

    /** Giá trị đã chọn theo ngôn ngữ: ưu tiên value, rồi value_<locale>, rồi value_en. */
    public function getResolvedAttribute()
    {
        if ($this->value !== null && $this->value !== '') {
            return $this->value;
        }

        $locale = app()->getLocale();
        $translated = $this->{'value_'.$locale} ?? null;

        if ($translated === null || $translated === '') {
            $translated = $this->value_en;
        }

        return $translated;
    }
}
