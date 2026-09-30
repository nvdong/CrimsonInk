<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Ảnh minh họa của 4 phong cách có trang riêng.
 *
 * Trước đây mỗi phong cách có một view riêng với danh sách ảnh viết cứng
 * (realism 4 ảnh, japanese 15, tribal 3, cartoon 24). Bốn view đó đã bị gỡ,
 * thay bằng một trang dùng chung đọc ảnh từ bảng media theo tattoo_style_id.
 * Seeder này mang danh sách ảnh cũ vào DB.
 *
 * Chạy SAU TattooStylesSeeder (tra id theo slug).
 *
 * Idempotent — khóa theo (tattoo_style_id, path), chạy lại không sinh bản ghi
 * trùng và không đè thứ tự admin đã sắp lại.
 */
class TattooStyleMediaSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $groups = [
            'realism-tattoos' => [
                'Realism-tattoo-2.png', 'Realism-tattoo-3.png', 'Realism-tattoo-4.png', 'Realism-tattoo.png',
            ],
            'japanese-tattoos' => [
                'Japanese-tattoo-3.png', 'Japanese-tattoo-4.png', 'Japanese-tattoo-5.png', 'Japanese-tattoo-6.png',
                'Japanese-tattoo-7.png', 'Japanese-tattoo-8.png', 'Japanese-tattoo-9.png', 'Japanese-tattoo-10.png',
                'Japanese-tattoo-12.png', 'Japanese-tattoo-14.png', 'Japanese-tattoo-15.png', 'Japanese-tattoo-16.png',
                'Japanese-tattoo-17.png', 'Japanese-tattoo.png', 'Japanese-tattoo-61.png',
            ],
            'tribal-tattoos' => [
                'Tribal-tattoo-2.png', 'Tribal-tattoo-3.png', 'Tribal-tattoo.png',
            ],
            'cartoon-tattoos' => [
                'Cartoon-tattoo-2.png', 'Cartoon-tattoo-3.png', 'Cartoon-tattoo-4.png', 'Cartoon-tattoo-5.png',
                'Cartoon-tattoo-6.png', 'Cartoon-tattoo-7.png', 'Cartoon-tattoo-8.png', 'Cartoon-tattoo-9.png',
                'Cartoon-tattoo-10.png', 'Cartoon-tattoo-11.png', 'Cartoon-tattoo-12.png', 'Cartoon-tattoo-13.png',
                'Cartoon-tattoo-14.png', 'Cartoon-tattoo-15.png', 'Cartoon-tattoo-16.png', 'Cartoon-tattoo-17.png',
                'Cartoon-tattoo-18.png', 'Cartoon-tattoo-19.png', 'Cartoon-tattoo-20.png', 'Cartoon-tattoo-21.png',
                'Cartoon-tattoo-22.png', 'Cartoon-tattoo-23.png', 'Cartoon-tattoo-24.png', 'Cartoon-tattoo.png',
            ],
        ];

        foreach ($groups as $slug => $files) {
            $style = DB::table('tattoo_styles')->where('slug', $slug)->first();

            if (! $style) {
                $this->command->warn('TattooStyleMediaSeeder: không có style "'.$slug.'" — bỏ qua.');

                continue;
            }

            $sort = 0;

            foreach ($files as $file) {
                $sort += 10;

                $key = [
                    'tattoo_style_id' => $style->id,
                    'path'            => 'assets/images/'.$file,
                ];

                if (DB::table('media')->where($key)->exists()) {
                    continue;
                }

                DB::table('media')->insert($key + [
                    'mediable_type' => 'App\Models\TattooStyle',
                    'mediable_id'   => $style->id,
                    'collection'    => 'gallery',
                    'type'          => 'image',
                    'alt_en'        => $style->name_en.' tattoo at CrimsonInk Tattoo Studio',
                    'alt_vi'        => 'Xăm '.$style->name_vi.' tại CrimsonInk Tattoo Studio',
                    'is_active'     => true,
                    'sort_order'    => $sort,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ]);
            }
        }
    }
}
