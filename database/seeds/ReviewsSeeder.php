<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 3 review ở block "My Happy Clients!" — gom từ mảng $clientReviews
 * trong pages/home.blade.php.
 *
 * CHÚ Ý: đây vẫn là PLACEHOLDER. source để 'manual' chứ KHÔNG để 'google',
 * vì hiện chưa có review Google thật nào của Crimson Ink — gắn logo Google lên
 * nội dung tự viết là mạo nhận. Khi có review thật thì đổi source sang 'google'
 * và điền source_url trỏ về review gốc.
 */
class ReviewsSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $rows = [
            ['Khách hàng 1', 5, '2 tuần trước',  14],
            ['Khách hàng 2', 5, '3 tuần trước',  21],
            ['Khách hàng 3', 5, '1 tháng trước', 30],
        ];

        $data = [];
        foreach ($rows as $i => $r) {
            $data[] = [
                'author_name'        => $r[0],
                'author_avatar_path' => null,
                'author_country'     => null,
                'rating'             => $r[1],
                'content_en'         => 'Replace this with a real client review.',
                'content_vi'         => 'Thay bằng nội dung review thật của khách.',
                'source'             => 'manual',
                'source_url'         => null,
                'reviewed_at'        => $now->copy()->subDays($r[3])->toDateString(),
                'artist_id'          => null,
                'is_featured'        => true,
                'is_active'          => true,
                'sort_order'         => $i + 1,
                'created_at'         => $now,
                'updated_at'         => $now,
            ];
        }

        DB::table('reviews')->insert($data);
    }
}
