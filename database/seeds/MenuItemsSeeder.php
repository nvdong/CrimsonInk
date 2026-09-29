<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Menu chính trên header — gom từ <ul id="menu-main-menu"> trong
 * resources/views/partials/header.blade.php.
 *
 * Seeder CHẠY LẠI ĐƯỢC: xóa sạch các dòng location = 'header' rồi nạp lại,
 * nên id sẽ đổi sau mỗi lần chạy. Các location khác không bị đụng tới.
 *
 * ĐÃ SỬA SO VỚI BẢN CŨ:
 *   - "Artists" trước trỏ page.eyebrows-tattoo -> nay trỏ page.artists
 *
 * CÒN TỒN ĐỌNG (giữ nguyên, sửa khi bạn quyết):
 *   - "Blog" đang để href="#", chưa có trang blog
 */
class MenuItemsSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        DB::table('menu_items')->where('location', 'header')->delete();

        // label_en, label_vi, route_name, url
        $top = [
            ['Home',         'Trang chủ',       'page.home',          null],
            ['About Us',     'Giới thiệu',      'page.about-us',      null],
            ['Tattoo Styles','Phong cách xăm',  'page.tattoo-styles', null],
            ['Gallery',      'Thư viện ảnh',    'page.gallery',       null],
            ['Artists',      'Đội ngũ artist',  'page.artists',       null],
            ['FAQs',         'Câu hỏi thường gặp', 'page.faqs',       null],
            ['Blog',         'Blog',             null,                '#'],
            ['Contact Us',   'Liên hệ',         'page.contact-us',    null],
        ];

        foreach ($top as $i => $r) {
            DB::table('menu_items')->insert([
                'location'     => 'header',
                'parent_id'    => null,
                'label_en'     => $r[0],
                'label_vi'     => $r[1],
                'route_name'   => $r[2],
                'url'          => $r[3],
                'target_blank' => false,
                'is_active'    => true,
                'sort_order'   => ($i + 1) * 10,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);
        }

        // menu con của "Tattoo Styles"
        $parentId = DB::table('menu_items')
            ->where('location', 'header')
            ->where('route_name', 'page.tattoo-styles')
            ->value('id');

        if (! $parentId) {
            $this->command->warn('MenuItemsSeeder: không tìm thấy mục cha Tattoo Styles — bỏ qua menu con.');

            return;
        }

        $children = [
            ['Japanese Tattoos', 'Xăm Nhật Bản',   'page.tattoo-styles.japanese-tattoos'],
            ['Realism Tattoos',  'Xăm tả thực',    'page.tattoo-styles.realism-tattoos'],
            ['Tribal Tattoos',   'Xăm thổ dân',    'page.tattoo-styles.tribal-tattoos'],
            ['Cartoon Tattoos',  'Xăm hoạt hình',  'page.tattoo-styles.cartoon-tattoos'],
        ];

        foreach ($children as $i => $r) {
            DB::table('menu_items')->insert([
                'location'     => 'header',
                'parent_id'    => $parentId,
                'label_en'     => $r[0],
                'label_vi'     => $r[1],
                'route_name'   => $r[2],
                'url'          => null,
                'target_blank' => false,
                'is_active'    => true,
                'sort_order'   => ($i + 1) * 10,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);
        }
    }
}
