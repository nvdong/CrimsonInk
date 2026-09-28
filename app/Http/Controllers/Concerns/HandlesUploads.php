<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Lưu ảnh admin upload vào public/upload/<thư mục>/<năm>/<tháng>.
 *
 * Trả về đường dẫn TƯƠNG ĐỐI tính từ public/ (vd upload/page/2026/09/hero-17...jpg)
 * đúng quy ước của mọi cột *_path trong DB — render bằng asset($path).
 */
trait HandlesUploads
{
    protected function storeUpload(Request $request, $field, $folder, $current = null)
    {
        if (! $request->hasFile($field)) {
            return $current;
        }

        $file = $request->file($field);

        $dir = 'upload/'.trim($folder, '/').'/'.date('Y/m');
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $name = ($name ?: 'file').'-'.time().'.'.strtolower($file->getClientOriginalExtension());

        $file->move(public_path($dir), $name);

        return $dir.'/'.$name;
    }
}
