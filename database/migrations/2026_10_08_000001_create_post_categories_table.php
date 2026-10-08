<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Danh mục bài viết blog — nhãn hiện đè lên ảnh ở trang /blog và dòng
 * breadcrumb "Trang chủ / <danh mục>" ở trang chi tiết.
 *
 * Chỉ tiếng Anh, không có cặp _en/_vi như các bảng nội dung khác.
 *
 * Chạy TRƯỚC create_posts_table vì posts.category_id trỏ sang đây — tuy không
 * có FK constraint nhưng giữ đúng thứ tự cho dễ đọc.
 */
class CreatePostCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug', 120)->unique();
            $table->string('name', 120);
            $table->string('description', 255)->nullable();

            $table->smallInteger('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_categories');
    }
}
