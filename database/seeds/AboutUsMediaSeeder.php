<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 8 ảnh của trang /about-us.
 *
 * Trước đây 8 đường dẫn này fix cứng trong mảng $arrImgs ở about-us.blade.php.
 * Seeder đưa chúng vào bảng media để admin sửa được, view chỉ còn vòng lặp.
 *
 * Chạy SAU PagesSeeder: ảnh gắn vào dòng page có slug 'about-us'.
 *
 * Idempotent — khóa theo (mediable, collection, path), chạy lại không sinh
 * bản ghi trùng và không đè thứ tự admin đã sắp lại.
 */
class AboutUsMediaSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $pageId = DB::table('pages')->where('slug', 'about-us')->value('id');

        if (! $pageId) {
            $this->command->warn('AboutUsMediaSeeder: chưa có page slug "about-us" — bỏ qua.');

            return;
        }

        for ($i = 1; $i <= 8; $i++) {
            $key = [
                'mediable_type' => 'App\Models\Page',
                'mediable_id'   => $pageId,
                'collection'    => 'gallery',
                'path'          => 'imgs/about-us-'.$i.'.jpg',
            ];

            $exists = DB::table('media')->where($key)->exists();

            if ($exists) {
                continue;
            }

            DB::table('media')->insert($key + [
                'type'       => 'image',
                'alt_en'     => 'CrimsonInk Tattoo Studio',
                'alt_vi'     => 'CrimsonInk Tattoo Studio',
                'is_active'  => true,
                'sort_order' => $i * 10,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
