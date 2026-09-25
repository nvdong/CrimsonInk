<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Các block trong một trang — hero, why_choose, styles, artists, reviews, cta.
 * Cho phép sửa tiêu đề song ngữ và nút CTA mà không phải đụng file blade.
 *
 * Không có FK: xóa một page thì phải tự xóa sections của nó trong code
 * (đặt trong sự kiện deleting của model Page).
 */
class CreatePageSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('page_id')->index();

            // hero | why_choose | styles | artists | reviews | cta
            $table->string('key', 60);
            $table->string('type', 40)->default('rich_text');

            // dòng nhỏ phía trên tiêu đề: "Welcome to", "Explore Our", "Meet Our"
            $table->string('eyebrow_en', 120)->nullable();
            $table->string('eyebrow_vi', 120)->nullable();
            $table->string('heading_en', 190)->nullable();
            $table->string('heading_vi', 190)->nullable();
            $table->string('subheading_en', 255)->nullable();
            $table->string('subheading_vi', 255)->nullable();
            $table->text('body_en')->nullable();
            $table->text('body_vi')->nullable();

            $table->string('image_path', 255)->nullable();
            $table->string('background_path', 255)->nullable();

            $table->string('cta_label_en', 80)->nullable();
            $table->string('cta_label_vi', 80)->nullable();
            $table->string('cta_route', 120)->nullable();
            $table->string('cta_url', 255)->nullable();

            // {"limit": 4, "autoplay": true} — tham số riêng của từng loại block
            $table->json('settings')->nullable();

            $table->boolean('is_active')->default(true);
            $table->smallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->unique(['page_id', 'key'], 'page_sections_page_key_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_sections');
    }
}
