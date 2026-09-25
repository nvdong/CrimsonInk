<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 4 artist — gom từ config/artists.php.
 *
 * Chạy SAU TattooStylesSeeder: tattoo_style_ids được tra ngược từ slug style,
 * nên bảng tattoo_styles phải có dữ liệu trước.
 *
 * is_featured = true thay cho config 'home_limit' cũ: trang chủ lấy các artist
 * featured, hết featured thì nút "View all artists" tự ẩn.
 *
 * CHÚ Ý: ảnh và bio vẫn là PLACEHOLDER lấy từ site gốc. Thay bằng ảnh và mô tả
 * thật của artist Crimson Ink trước khi đưa lên production.
 */
class ArtistsSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $bioVi = 'Mô tả ngắn về artist: phong cách sở trường, số năm kinh nghiệm, '
               . 'điều khiến khách quay lại. Khoảng 2-3 dòng là vừa đẹp với bố cục này.';
        $bioEn = 'A short introduction: signature styles, years of experience and what '
               . 'keeps clients coming back. Two or three lines fit this layout best.';

        // slug style -> id
        $styleIds = DB::table('tattoo_styles')->pluck('id', 'slug');

        $pick = function (array $slugs) use ($styleIds) {
            $ids = [];
            foreach ($slugs as $slug) {
                if (isset($styleIds[$slug])) {
                    $ids[] = (int) $styleIds[$slug];
                }
            }

            return json_encode($ids);
        };

        // slug, name, role_en, role_vi, avatar, style slugs
        $rows = [
            ['minh-khoa', 'Minh Khoa', 'Fineline & Blackwork',  'Fineline & Blackwork',
             'tattoo-artist-1.jpg',            ['fineline', 'blackwork']],
            ['bao-long',  'Bảo Long',  'Realism & Portrait',    'Tả thực & Chân dung',
             'tattoo-artist-2.jpg',            ['realism-tattoos']],
            ['ha-vy',     'Hà Vy',     'Japanese & Traditional','Nhật Bản & Truyền thống',
             'tattoo-artist-3.jpg',            ['japanese-tattoos', 'traditional']],
            ['duc-anh',   'Đức Anh',   'Dotwork & Ornamental',  'Chấm điểm & Hoa văn',
             'junk-juz-tattoo-artist-bali.jpg',['dotwork']],
        ];

        $data = [];
        foreach ($rows as $i => $r) {
            $data[] = [
                'slug'             => $r[0],
                'name_en'          => $r[1],
                'name_vi'          => $r[1],
                'role_en'          => $r[2],
                'role_vi'          => $r[3],
                'bio_en'           => $bioEn,
                'bio_vi'           => $bioVi,
                'content_en'       => null,
                'content_vi'       => null,
                'tattoo_style_ids' => $pick($r[5]),
                'avatar_path'      => 'assets/images/'.$r[4],
                'cover_path'       => null,
                'experience_years' => null,
                'socials'          => null,
                'is_featured'      => true,
                'is_active'        => true,
                'sort_order'       => $i + 1,
                'created_at'       => $now,
                'updated_at'       => $now,
            ];
        }

        DB::table('artists')->insert($data);
    }
}
