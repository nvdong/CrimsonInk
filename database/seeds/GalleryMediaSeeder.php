<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 20 ảnh của trang /gallery.
 *
 * Trang gallery hiện là một bản chụp tĩnh của widget Instagram Feed
 * (Smash Balloon): mỗi ô là một <a class="sbi_photo"> với ảnh thật nằm trong
 * data-full-res, còn thẻ <img> chỉ là placeholder.png. Seeder này rút 20 ảnh
 * thật đó ra DB để sau này render bằng vòng lặp thay cho markup của widget.
 *
 * Chạy SAU PagesSeeder: ảnh gắn vào dòng page có slug 'gallery'.
 *
 * CHÚ Ý: caption là caption Instagram của studio gốc ở Bali — PLACEHOLDER.
 * Hai caption mang thông tin liên hệ của studio cũ đã được thay bằng ghi chú.
 */
class GalleryMediaSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $pageId = DB::table('pages')->where('slug', 'gallery')->value('id');

        if (! $pageId) {
            $this->command->warn('GalleryMediaSeeder: chưa có page slug "gallery" — bỏ qua.');

            return;
        }

        $rows = [
            ['path' => 'assets/images/ext-scontentcgk22-71932086114689_2992458166866653174_n.jpg',
             'alt_en' => 'Small lines with big meaning, it’s easy to see why fine line tattoos are a favorite 🖤🤩',
             'caption_en' => 'Small lines with big meaning, it’s easy to see why fine line tattoos are a favorite 🖤🤩'],
            ['path' => 'assets/images/ext-scontentcgk21-71560905114689_1190225360991079783_n.jpg',
             'alt_en' => '📍 Prefer to talk in person?',
             'caption_en' => '📍 Prefer to talk in person?'],
            ['path' => 'assets/images/ext-scontentcgk22-70116282114689_7085329359733970096_n.jpg',
             'alt_en' => 'The Kraken Curse 💀⚓️🐙',
             'caption_en' => 'The Kraken Curse 💀⚓️🐙'],
            ['path' => 'assets/images/ext-scontentcgk22-69943959114689_1155432106259041391_n.jpg',
             'alt_en' => 'Black and grey Octopus 🐙 ,custom made. Thank you brother for the trust 🙏🖤',
             'caption_en' => 'Black and grey Octopus 🐙 ,custom made. Thank you brother for the trust 🙏🖤'],
            ['path' => 'assets/images/ext-scontentcgk22-68166255114689_5475073316086351570_n.jpg',
             'alt_en' => 'Studio work',
             'caption_en' => 'Thay bằng caption thật của Crimson Ink.'],
            ['path' => 'assets/images/ext-scontentcgk22-67813647114689_6693890198391297788_n.jpg',
             'alt_en' => 'Cover-up Tattoo! Before and After Result 🔥🐲',
             'caption_en' => 'Cover-up Tattoo! Before and After Result 🔥🐲'],
            ['path' => 'assets/images/ext-scontentcgk11-67010559114689_3585207281467755615_n.jpg',
             'alt_en' => 'Dark Lace Femme Gothic Tattoo. 🖤🔥',
             'caption_en' => 'Dark Lace Femme Gothic Tattoo. 🖤🔥'],
            ['path' => 'assets/images/ext-scontentcgk21-66871764114689_5521703402726660541_n.jpg',
             'alt_en' => 'Hand rose and love heart tattoo 🌹🖤',
             'caption_en' => 'Hand rose and love heart tattoo 🌹🖤'],
            ['path' => 'assets/images/ext-scontentcgk22-66857250114689_6187879796236403058_n.jpg',
             'alt_en' => 'Hand mask tattoo 👹💥',
             'caption_en' => 'Hand mask tattoo 👹💥'],
            ['path' => 'assets/images/ext-scontentcgk12-65571918114689_5303473502543576605_n.jpg',
             'alt_en' => 'Yesterday’s Owl and geometrical tattoo. Thank you 🙏',
             'caption_en' => 'Yesterday’s Owl and geometrical tattoo. Thank you 🙏'],
            ['path' => 'assets/images/ext-scontentcgk12-64959408114689_6863282894952290924_n.jpg',
             'alt_en' => 'American traditional/neo traditional Cartoon Bomb tattoo 💣💣',
             'caption_en' => 'American traditional/neo traditional Cartoon Bomb (boom) tattoo 💣💣'],
            ['path' => 'assets/images/ext-scontentcgk21-64227957114689_1478979128825284376_n.jpg',
             'alt_en' => 'A custom of black and grey bear, ibex and bee tattoo 🙏',
             'caption_en' => 'A custom of black and grey bear, ibex and bee tattoo. Thanks brother for the trust 🙏'],
            ['path' => 'assets/images/ext-scontentcgk21-63829773114689_1571867816168016646_n.jpg',
             'alt_en' => 'Cover-up work',
             'caption_en' => 'If you need some old tattoos to be covered up, check out some of our cover-up work.'],
            ['path' => 'assets/images/ext-scontentcgk21-63320946114689_9008939654080199522_n.jpg',
             'alt_en' => 'Dragon in black and grey with roses 🐉🌹',
             'caption_en' => 'Dragon in black and grey with roses 🐉🌹 ..thank you heaps brother 🙏'],
            ['path' => 'assets/images/ext-scontentcgk12-462820819114689_185774594112390677_n.jpg',
             'alt_en' => 'Studio work',
             'caption_en' => 'Thay bằng caption thật của Crimson Ink.'],
            ['path' => 'assets/images/ext-scontentcgk11-62771358114689_6465686018843637992_n.jpg',
             'alt_en' => 'Full back piece Hannya mask 🙏',
             'caption_en' => 'Full back piece Hannya mask done! Thank you loads brother 🙏'],
            ['path' => 'assets/images/ext-scontentcgk21-62595753114689_3225290629889647103_n.jpg',
             'alt_en' => 'Cover-up Japanese Samurai! 🙏',
             'caption_en' => 'Cover-up Japanese Samurai! 🙏'],
            ['path' => 'assets/images/ext-scontentcgk11-62094141114689_1380918085777632707_n.jpg',
             'alt_en' => 'Full sleeve nature tattoo in black and grey 🙏',
             'caption_en' => 'Full sleeve nature tattoo in black and grey. Thank you brother Adam 🙏'],
            ['path' => 'assets/images/ext-scontentcgk22-61296801114689_7642999274555102154_n.jpg',
             'alt_en' => 'Kewpie doll tattoo 🙏',
             'caption_en' => 'Still cute in horror — Kewpie doll tattoo. Thank you Steph 🙏'],
            ['path' => 'assets/images/ext-scontentcgk21-59471586114689_1439567129567876270_n.jpg',
             'alt_en' => 'Custom design 🌙💫',
             'caption_en' => 'Done last night, 1 hour work — custom design 🌙💫'],
        ];

        $data = [];
        foreach ($rows as $i => $r) {
            $data[] = [
                'mediable_type'    => 'App\Models\Page',
                'mediable_id'      => $pageId,
                'collection'       => 'gallery',
                'type'             => 'image',
                'path'             => $r['path'],
                'poster_path'      => null,
                'embed_url'        => null,
                'alt_en'           => $r['alt_en'],
                'alt_vi'           => null,
                'caption_en'       => $r['caption_en'],
                'caption_vi'       => null,
                'width'            => null,
                'height'           => null,
                'duration_seconds' => null,
                'tattoo_style_id'  => null,
                'artist_id'        => null,
                'is_active'        => true,
                'sort_order'       => $i + 1,
                'created_at'       => $now,
                'updated_at'       => $now,
            ];
        }

        DB::table('media')->insert($data);
    }
}
