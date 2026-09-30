<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Slogan của artist — câu dẫn ngắn đặt làm tiêu đề khối "tác phẩm"
 * ở trang /artists/{slug}. Trước đó câu này hardcode trong view nên mọi
 * artist dùng chung một câu.
 *
 * Để trống thì trang tự lùi về câu mặc định, không vỡ layout.
 */
class AddSloganToArtistsTable extends Migration
{
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->string('slogan_en', 190)->nullable()->after('role_vi');
            $table->string('slogan_vi', 190)->nullable()->after('slogan_en');
        });
    }

    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropColumn(['slogan_en', 'slogan_vi']);
        });
    }
}
