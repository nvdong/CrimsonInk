<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Khung 10 trang hiện có trong routes/web.php.
 *
 * Seeder này chỉ tạo phần khung (slug, tiêu đề, meta) — phần body_en/body_vi
 * để trống, nội dung vẫn nằm trong file blade cho tới khi chuyển sang CMS.
 *
 * Cần chạy trước GalleryMediaSeeder: ảnh gallery gắn vào dòng page slug 'gallery'.
 *
 * 4 trang phong cách xăm (japanese/realism/tribal/cartoon) KHÔNG nằm ở đây —
 * chúng là dữ liệu của bảng tattoo_styles.
 */
class PagesSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        // slug, type, route_name, template, title_en, title_vi
        $rows = [
            ['home', 'landing', 'page.home', 'home',
             'Tattoo Studio in Hanoi', 'Tiệm xăm tại Hà Nội'],

            ['about-us', 'page', 'page.about-us', 'default',
             'About Us', 'Về chúng tôi'],

            ['faqs', 'page', 'page.faqs', 'default',
             'Frequently Asked Questions', 'Câu hỏi thường gặp'],

            ['gallery', 'page', 'page.gallery', 'gallery',
             'Gallery', 'Thư viện ảnh'],

            ['contact-us', 'landing', 'page.contact-us', 'booking',
             'Book Your Appointment', 'Đặt lịch xăm'],

            ['artists', 'page', 'page.artists', 'default',
             'Our Artists', 'Đội ngũ artist'],

            ['tattoo-styles', 'page', 'page.tattoo-styles', 'default',
             'Tattoo Styles', 'Phong cách xăm'],
        ];

        $data = [];
        foreach ($rows as $i => $r) {
            $data[] = [
                'slug'                 => $r[0],
                'type'                 => $r[1],
                'route_name'           => $r[2],
                'template'             => $r[3],
                'title_en'             => $r[4],
                'title_vi'             => $r[5],
                'heading_en'           => null,
                'heading_vi'           => null,
                'body_en'              => null,
                'body_vi'              => null,
                'hero_image_path'      => null,
                'meta_title_en'        => null,
                'meta_title_vi'        => null,
                'meta_description_en'  => null,
                'meta_description_vi'  => null,
                'og_image_path'        => null,
                'canonical_url'        => null,
                'noindex'              => false,
                'is_active'            => true,
                'sort_order'           => $i + 1,
                'created_at'           => $now,
                'updated_at'           => $now,
            ];
        }

        DB::table('pages')->insert($data);
    }
}
