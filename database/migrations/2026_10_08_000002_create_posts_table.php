<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Bài viết blog — trang /blog và /blog/{slug}.
 * Thay cho mảng cắm cứng trong PageController::demoPosts().
 *
 * Chỉ tiếng Anh, không có cặp _en/_vi.
 *
 * NGÀY THÁNG: cả ô ngày trên thẻ ở trang danh sách lẫn dòng "Cập nhật lần
 * cuối" ở trang chi tiết đều đọc created_at. Laravel tự điền lúc insert, nhưng
 * cột này vẫn sửa được từ admin — cần đăng lại bài cũ với ngày cũ thì cho sửa
 * created_at trong form là xong, không cần thêm cột published_at.
 *
 * Quan hệ ngầm, chỉ index, KHÔNG có FK constraint:
 *   category_id -> post_categories.id
 *   user_id     -> users.id (ai tạo bài, để lọc trong admin)
 *
 * Ảnh chèn trong thân bài dùng chung bảng media (quan hệ đa hình), chỉ cần
 * thêm 'App\Models\Post' vào mảng $owners của MediaController.
 */
class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug', 160)->unique();
            $table->string('title', 190);
            $table->string('excerpt', 300)->nullable();
            $table->longText('content')->nullable();

            // đường dẫn tương đối tính từ public/, render bằng asset()
            $table->string('cover_path', 255)->nullable();

            // hộp "Điểm chính" — mảng chuỗi (có thể chứa thẻ <b>), sửa bằng
            // trình soạn repeater trong admin giống social.links
            $table->json('takeaways')->nullable();

            // dòng "Đăng bởi" ngoài site — để text tự do, không buộc vào users
            $table->string('author_name', 120)->nullable();

            $table->unsignedInteger('category_id')->nullable()->index();
            $table->unsignedInteger('user_id')->nullable()->index();

            $table->string('meta_title', 190)->nullable();
            $table->string('meta_description', 300)->nullable();

            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();
            $table->softDeletes();

            // trang /blog luôn lọc is_active rồi sắp theo ngày giảm dần
            $table->index(['is_active', 'created_at'], 'posts_active_created_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
