<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Cấu hình toàn site.
 *
 * Gom từ: config/social.php, config/locales.php và phần thông tin studio
 * đang hardcode trong header.blade.php / footer.blade.php.
 *
 * value             -> giá trị không cần dịch
 * value_en/value_vi -> giá trị cần dịch
 *
 * Seeder này CHẠY LẠI ĐƯỢC (updateOrInsert theo cặp group+key).
 * CHÚ Ý: chạy lại sẽ ghi đè giá trị bạn đã sửa trong admin.
 */
class SettingsSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $rows = [
            // ----- studio: hiện ở header và footer -----
            ['studio', 'name',      'text', 'Crimson Ink', null, null, 1],
            ['studio', 'logo_path', 'image', 'assets/imgs/logo.png', null, null, 2],
            ['studio', 'phone',     'text', '+84 346.955.898', null, null, 3],
            ['studio', 'phone_url', 'text', 'tel:+84346955898', null, null, 4],
            ['studio', 'whatsapp_url', 'text', 'https://wa.me/84346955898', null, null, 5],
            ['studio', 'email',     'text', 'luuphongnha1990@gmail.com', null, null, 6],
            ['studio', 'address',   'text', null,
                '98 Quan Thanh, Ba Dinh, Hanoi, Viet Nam',
                '98 Quán Thánh, Ba Đình, Hà Nội, Việt Nam', 7],

            // Work Time trong footer là 2 ô riêng -> 2 dòng riêng
            ['studio', 'open_days', 'text', null,
                'Open Daily', 'Mở cửa tất cả các ngày', 8],
            ['studio', 'open_hours', 'text', '10 am – 18 pm', null, null, 9],

            ['studio', 'map_embed_url', 'text',
                'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.7607082127593!2d105.84125917606741!3d21.04225858061056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab23b20878bf%3A0xd2848ff4501761e0!2sHanoiink%20Tattoo!5e0!3m2!1svi!2s!4v1789201926546!5m2!1svi!2s',
                null, null, 10],

            ['studio', 'copyright', 'text', null,
                'Copyright © 2026 CrimsonInk. All rights reserved',
                'Copyright © 2026 CrimsonInk. Bảo lưu mọi quyền', 11],

            // ----- i18n: thay cho config/locales.php -----
            ['i18n', 'locales', 'json', json_encode([
                ['code' => 'vi', 'label' => 'Tiếng Việt', 'flag_path' => 'assets/imgs/vnflat.png', 'is_default' => true],
                ['code' => 'en', 'label' => 'English',    'flag_path' => 'assets/imgs/ukflat.png', 'is_default' => false],
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), null, null, 1],

            // ----- social: thay cho config/social.php -----
            // footer = hiện dưới footer, dock = thanh neo góc dưới phải
            ['social', 'links', 'json', json_encode([
                ['platform' => 'whatsapp',  'label' => 'WhatsApp',  'url' => 'https://wa.me/84346955898',
                 'icon' => 'fab fa-whatsapp',   'footer' => true, 'dock' => true,  'header' => false, 'sort' => 1],
                ['platform' => 'instagram', 'label' => 'Instagram', 'url' => 'https://www.instagram.com/crimsonink.tattoo/',
                 'icon' => 'fab fa-instagram',  'footer' => true, 'dock' => true,  'header' => false, 'sort' => 2],
                ['platform' => 'facebook',  'label' => 'Facebook',  'url' => 'https://www.facebook.com/',
                 'icon' => 'fab fa-facebook-f', 'footer' => true, 'dock' => true,  'header' => false, 'sort' => 3],
                ['platform' => 'phone',     'label' => 'Phone',     'url' => 'tel:+84346955898',
                 'icon' => 'fas fa-phone-alt',  'footer' => true, 'dock' => false, 'header' => false, 'sort' => 4],
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), null, null, 1],

            // ----- booking -----
            ['booking', 'notify_email', 'text', null, null, null, 1],
            ['booking', 'code_prefix',  'text', 'CI', null, null, 2],

            // ----- khối "My Happy Clients" ở trang chủ -----
            // Ba khóa này chỉ là con số hiển thị, nhập tay. Nội dung từng
            // review quản lý ở màn hình riêng (admin > Đánh giá khách hàng).
            ['studio', 'reviews_url',   'text', 'https://maps.app.goo.gl/zjJVxSN8SqzV4162A', null, null, 20],
            ['studio', 'rating',        'text', null, null, null, 21],
            ['studio', 'rating_count',  'text', null, null, null, 22],
        ];

        // Các khóa admin tự nhập giá trị; chạy lại seeder thì giữ nguyên,
        // không ghi đè về mặc định.
        $keepExisting = ['studio.rating', 'studio.rating_count', 'studio.reviews_url'];

        foreach ($rows as $r) {
            if (in_array($r[0].'.'.$r[1], $keepExisting, true)
                && DB::table('settings')->where('group', $r[0])->where('key', $r[1])->exists()) {
                continue;
            }

            DB::table('settings')->updateOrInsert(
                ['group' => $r[0], 'key' => $r[1]],
                [
                    'type'       => $r[2],
                    'value'      => $r[3],
                    'value_en'   => $r[4],
                    'value_vi'   => $r[5],
                    'sort_order' => $r[6],
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }

        // Khóa cũ đã bị tách thành open_days + open_hours
        DB::table('settings')->where('group', 'studio')->where('key', 'opening_hours')->delete();

        // Nhóm google (API key Places, place_id...) đã bỏ: review giờ nhập tay
        // ở admin > Đánh giá khách hàng, site không gọi Google nữa.
        DB::table('settings')->where('group', 'google')->delete();
    }
}
