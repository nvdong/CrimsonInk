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
        if ($request->file == null) {
            return $current;
        }

        $file = $request->file($field);

        $dir = 'upload/'.trim($folder, '/').'/'.date('Y/m');
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $name = ($name ?: 'file').'-'.time().'.'.strtolower($file->getClientOriginalExtension());

        $file->move(public_path($dir), $name);

        return $dir.'/'.$name;
    }

    /**
     * Bản nhiều file của storeUpload — dùng cho ô <input type="file" multiple>.
     *
     * Trả về mảng đường dẫn tương đối, theo đúng thứ tự người dùng chọn.
     * Tên file gắn uniqid() chứ không phải time() như bản một file: upload
     * nhiều ảnh cùng lúc thì time() giống nhau và các file ghi đè lên nhau.
     */
    protected function storeUploads(Request $request, $field, $folder)
    {
        $paths = [];

        if (! $request->hasFile($field)) {
            return $paths;
        }

        $dir = 'upload/'.trim($folder, '/').'/'.date('Y/m');

        foreach ((array) $request->file($field) as $file) {
            if (! $file || ! $file->isValid()) {
                continue;
            }

            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $name = ($name ?: 'file').'-'.uniqid().'.'.strtolower($file->getClientOriginalExtension());

            $file->move(public_path($dir), $name);

            $paths[] = $dir.'/'.$name;
        }

        return $paths;
    }
}
