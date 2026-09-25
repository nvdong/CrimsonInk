<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Cấu hình toàn site dạng key-value.
 *
 * - value            : giá trị KHÔNG cần dịch (SĐT, email, đường dẫn ảnh, JSON cấu hình)
 * - value_en/value_vi: chỉ dùng khi nội dung cần dịch (địa chỉ, giờ mở cửa, copyright)
 *
 * Thay cho config/social.php, config/locales.php và phần thông tin studio
 * đang hardcode trong resources/views/partials/footer.blade.php.
 */
class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');

            // studio | i18n | social | seo | booking | auth
            $table->string('group', 40)->index();
            $table->string('key', 80);

            // quyết định widget hiển thị trong admin
            $table->enum('type', ['text', 'textarea', 'html', 'image', 'number', 'bool', 'json'])
                  ->default('text');

            $table->text('value')->nullable();
            $table->text('value_en')->nullable();
            $table->text('value_vi')->nullable();

            $table->smallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['group', 'key'], 'settings_group_key_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
