<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 12 phong cách xăm — gom từ mảng $tattooStyles trong pages/home.blade.php.
 *
 * 4 style đã có trang chi tiết riêng, 8 style còn lại has_detail_page = false
 * nên thẻ trong carousel sẽ trỏ về /tattoo-styles.
 *
 * sort_order quyết định số thứ tự in trên thẻ ("1. Fineline").
 */
class TattooStylesSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        // slug, name_en, name_vi, cover, route_name
        $rows = [
            ['fineline',         'Fineline',    'Fineline',        'tattoo-gallery-1.jpg',              null],
            ['blackwork',        'Blackwork',   'Blackwork',       'tattoo-gallery-2.jpg',              null],
            ['traditional',      'Traditional', 'Truyền thống',    'tattoo-gallery-3.jpg',              null],
            ['realism-tattoos',  'Realism',     'Tả thực',         'Realism-tattoo-31-1-768x670.png',   'page.tattoo-styles.realism-tattoos'],
            ['japanese-tattoos', 'Japanese',    'Nhật Bản',        'Japanese-tattoo-61-768x670.png',    'page.tattoo-styles.japanese-tattoos'],
            ['tribal-tattoos',   'Tribal',      'Thổ dân',         'Tribal-tattoo-21-768x670.png',      'page.tattoo-styles.tribal-tattoos'],
            ['cartoon-tattoos',  'Cartoon',     'Hoạt hình',       'cartoon-tattoo--768x670.png',       'page.tattoo-styles.cartoon-tattoos'],
            ['lettering',        'Lettering',   'Chữ',             'tattoo-gallery-4.jpg',              null],
            ['big-piece',        'Big Piece',   'Mảng lớn',        'tattoo-gallery-5.jpg',              null],
            ['dotwork',          'Dotwork',     'Chấm điểm',       'tattoo-gallery-6.jpg',              null],
            ['landscape',        'Landscape',   'Phong cảnh',      'tattoo-gallery-7.jpg',              null],
            ['demon',            'Demon',       'Quỷ dữ',          'tattoo-gallery-8.jpg',              null],
        ];

        $data = [];
        foreach ($rows as $i => $r) {
            $data[] = [
                'slug'            => $r[0],
                'name_en'         => $r[1],
                'name_vi'         => $r[2],
                'excerpt_en'      => null,
                'excerpt_vi'      => null,
                'content_en'      => null,
                'content_vi'      => null,
                'cover_path'      => 'assets/images/'.$r[3],
                'has_detail_page' => $r[4] !== null,
                'route_name'      => $r[4],
                'is_featured'     => true,
                'is_active'       => true,
                'sort_order'      => $i + 1,
                'created_at'      => $now,
                'updated_at'      => $now,
            ];
        }

        DB::table('tattoo_styles')->insert($data);
    }
}
