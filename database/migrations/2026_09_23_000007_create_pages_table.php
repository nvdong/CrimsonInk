<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Các trang nội dung tự do: about-us, piercing, exhibition, gallery,
 * eyebrows-tattoo, best-tattoo-studio... kèm toàn bộ phần SEO.
 *
 * slug unique toàn site — một index duy nhất chặn được trùng URL.
 * type : page | service | landing
 *        piercing và eyebrows-tattoo hiện để type = service; ngày nào cần
 *        giá / thời gian thực hiện riêng thì tách các dòng đó sang bảng services.
 */
class CreatePagesTable extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 120)->unique();

            $table->enum('type', ['page', 'service', 'landing'])->default('page')->index();

            // giữ để không vỡ các route() đang dùng trong blade
            $table->string('route_name', 120)->nullable();
            $table->string('template', 60)->default('default');

            $table->string('title_en', 190);
            $table->string('title_vi', 190);
            $table->string('heading_en', 190)->nullable();
            $table->string('heading_vi', 190)->nullable();
            $table->longText('body_en')->nullable();
            $table->longText('body_vi')->nullable();

            $table->string('hero_image_path', 255)->nullable();

            $table->string('meta_title_en', 190)->nullable();
            $table->string('meta_title_vi', 190)->nullable();
            $table->string('meta_description_en', 300)->nullable();
            $table->string('meta_description_vi', 300)->nullable();
            $table->string('og_image_path', 255)->nullable();
            $table->string('canonical_url', 255)->nullable();
            $table->boolean('noindex')->default(false);

            $table->boolean('is_active')->default(true)->index();
            $table->smallInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
