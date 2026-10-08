<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Sinh slug từ tên/tiêu đề, tự thêm hậu tố khi trùng.
 *
 * Dùng cho các màn admin KHÔNG cho nhập slug bằng tay (blog, danh mục blog).
 * Bỏ ô nhập đi thì cũng mất luôn chỗ để người dùng tự sửa khi trùng, nên
 * trách nhiệm chống trùng chuyển hẳn về đây — không thì cột slug unique sẽ ném
 * SQLSTATE 23000 ra màn hình trắng.
 *
 * Kiểm tra bằng DB::table() chứ không qua Eloquent: bảng posts có soft delete,
 * bài đã xóa vẫn giữ chỗ trong unique index nên phải đếm cả nó.
 */
trait GeneratesSlug
{
    protected function uniqueSlug($source, $table, $ignoreId = null, $column = 'slug')
    {
        // Str::slug() bỏ dấu tiếng Việt; tiêu đề toàn ký tự lạ có thể ra rỗng.
        $base = Str::slug($source) ?: 'bai-viet';
        $slug = $base;
        $i = 2;

        while ($this->slugTaken($slug, $table, $ignoreId, $column)) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }

    private function slugTaken($slug, $table, $ignoreId, $column)
    {
        $query = DB::table($table)->where($column, $slug);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}
