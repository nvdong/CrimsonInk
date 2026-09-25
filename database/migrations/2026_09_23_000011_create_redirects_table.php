<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Chuyển hướng 301 quản lý bằng DB thay vì sửa routes/web.php mỗi lần đổi URL.
 * Thay cho 4 dòng Route::redirect hiện có.
 *
 * from_path / to_path lưu KHÔNG có dấu / đầu: "japanese-tattoos-2"
 */
class CreateRedirectsTable extends Migration
{
    public function up()
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->increments('id');

            $table->string('from_path', 255)->unique();
            $table->string('to_path', 255);
            $table->smallInteger('status_code')->default(301);

            $table->unsignedInteger('hits')->default(0);
            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('redirects');
    }
}
