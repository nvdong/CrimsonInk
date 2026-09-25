<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Thợ xăm. Dùng cho block trang chủ, trang /artists và /artists/{slug}.
 * Thay cho config/artists.php.
 *
 * tattoo_style_ids: mảng JSON id của tattoo_styles, thay cho bảng trung gian.
 * deleted_at      : soft delete — vì không có FK constraint nên đây là cách
 *                   giữ bookings/reviews cũ không bị mồ côi khi xóa thợ.
 */
class CreateArtistsTable extends Migration
{
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 120)->unique();

            $table->string('name_en', 120);
            $table->string('name_vi', 120);
            $table->string('role_en', 160)->nullable();
            $table->string('role_vi', 160)->nullable();
            $table->text('bio_en')->nullable();
            $table->text('bio_vi')->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_vi')->nullable();

            // [1, 3, 5] -> tattoo_styles.id
            $table->json('tattoo_style_ids')->nullable();

            // đường dẫn tương đối từ public/, không có dấu / đầu
            $table->string('avatar_path', 255)->nullable();
            $table->string('cover_path', 255)->nullable();

            $table->unsignedTinyInteger('experience_years')->nullable();

            // {"instagram": "...", "facebook": "..."}
            $table->json('socials')->nullable();

            $table->string('meta_title_en', 190)->nullable();
            $table->string('meta_title_vi', 190)->nullable();
            $table->string('meta_description_en', 300)->nullable();
            $table->string('meta_description_vi', 300)->nullable();

            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->smallInteger('sort_order')->default(0)->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artists');
    }
}
