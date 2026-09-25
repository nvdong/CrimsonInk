<?php

namespace App\Models\Concerns;

/**
 * Cho phép đọc trường song ngữ bằng tên gốc.
 *
 *   $artist->name   ->  name_vi khi locale = vi, name_en khi locale = en
 *                       rỗng bản dịch thì tự lùi về bản _en
 *
 * Model chỉ cần khai:  protected $translatable = ['name', 'role', 'bio'];
 */
trait HasTranslations
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if ($value !== null) {
            return $value;
        }

        $translatable = $this->translatable ?? [];

        if (! in_array($key, $translatable, true)) {
            return $value;
        }

        $locale = app()->getLocale();
        $translated = parent::getAttribute($key.'_'.$locale);

        if ($translated === null || $translated === '') {
            $translated = parent::getAttribute($key.'_en');
        }

        return $translated;
    }
}
