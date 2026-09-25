<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Bổ sung bảng users có sẵn để đăng nhập admin bằng Google OAuth.
 *
 * Ba cột mới:
 *   role       admin | editor
 *   google_id  sub claim của Google — khớp tài khoản theo id thay vì theo email,
 *              để người dùng đổi email Google vẫn đăng nhập được
 *   avatar_url URL ảnh Google trả về. Đây là ngoại lệ duy nhất không lưu
 *              đường dẫn tương đối, vì ảnh nằm trên máy chủ của Google.
 *
 * Ba cột sửa:
 *   password   NOT NULL -> NULL   tài khoản Google không có mật khẩu
 *   phone      NOT NULL -> NULL   Google không trả về số điện thoại.
 *                                 Unique vẫn giữ được: MySQL cho phép nhiều NULL
 *                                 trong cột unique.
 *   stat       thêm DEFAULT 0     user tạo từ OAuth callback mặc định = 0
 *                                 (chưa được phép đăng nhập) cho tới khi bạn
 *                                 duyệt lên 1 trong admin.
 *
 * Dùng DB::statement cho phần sửa cột để không phải cài thêm doctrine/dbal.
 */
class AddAdminFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'editor'])
                  ->default('editor')
                  ->after('full_name')
                  ->index();

            $table->string('google_id', 32)->nullable()->unique()->after('role');
            $table->string('avatar_url', 255)->nullable()->after('google_id');
        });

        DB::statement('ALTER TABLE `users` MODIFY `password` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `users` MODIFY `phone` VARCHAR(20) NULL');
        DB::statement('ALTER TABLE `users` MODIFY `stat` TINYINT NOT NULL DEFAULT 0');
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_role_index');
            $table->dropUnique('users_google_id_unique');
            $table->dropColumn(['role', 'google_id', 'avatar_url']);
        });

        // Lưu ý: hai lệnh dưới sẽ lỗi nếu trong bảng đang có dòng password
        // hoặc phone = NULL. Dọn dữ liệu trước khi rollback.
        DB::statement('ALTER TABLE `users` MODIFY `password` VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE `users` MODIFY `phone` VARCHAR(20) NOT NULL');
        DB::statement('ALTER TABLE `users` MODIFY `stat` TINYINT NOT NULL');
    }
}
