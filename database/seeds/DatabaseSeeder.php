<?php

use Illuminate\Database\Seeder;

/**
 * Thứ tự chạy có ràng buộc:
 *   PagesSeeder        trước GalleryMediaSeeder  (ảnh gắn vào page 'gallery')
 *   TattooStylesSeeder trước ArtistsSeeder       (artist tra id style theo slug)
 *
 * Chạy: php artisan db:seed
 * Chạy lại từ đầu: php artisan migrate:fresh --seed
 */
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SettingsSeeder::class,
            PagesSeeder::class,
            TattooStylesSeeder::class,
            ArtistsSeeder::class,
            ReviewsSeeder::class,
            GalleryMediaSeeder::class,
        ]);
    }
}
