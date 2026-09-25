<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Yêu cầu đặt lịch gửi từ /contact-us.
 * Thay cho Log::info trong App\Http\Controllers\ContactController@store.
 *
 * KHÔNG song ngữ: đây là dữ liệu khách tự nhập.
 * Cột locale ghi lại ngôn ngữ khách đang xem lúc bấm gửi.
 *
 * handled_by là bigint vì users.id của bảng có sẵn là bigint.
 */
class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');

            // CI-20260923-0001 — mã để trao đổi với khách
            $table->string('code', 20)->unique();

            $table->string('full_name', 120);
            $table->string('phone', 40);
            $table->string('email', 190)->index();

            $table->date('preferred_date')->nullable()->index();
            $table->time('preferred_time')->nullable();

            // quan hệ ngầm, chỉ index — xóa artist KHÔNG tự set null
            $table->unsignedInteger('artist_id')->nullable()->index();
            $table->unsignedInteger('tattoo_style_id')->nullable()->index();

            $table->string('placement', 120)->nullable();
            $table->string('size_cm', 40)->nullable();
            $table->text('message');

            // ["upload/bookings/2026/09/abc.jpg", ...]
            $table->json('reference_paths')->nullable();

            $table->enum('status', ['new', 'contacted', 'confirmed', 'done', 'cancelled'])
                  ->default('new');

            $table->text('admin_note')->nullable();
            $table->unsignedBigInteger('handled_by')->nullable()->index();

            $table->char('locale', 5)->default('vi');
            $table->string('ip', 45)->nullable();
            $table->string('user_agent', 255)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'created_at'], 'bookings_status_created_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
