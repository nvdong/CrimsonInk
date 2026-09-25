<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Đánh giá khách hàng ở block "My Happy Clients!".
 * Tĩnh hoàn toàn — không gọi Google Maps / Trustindex nữa.
 * Thay cho mảng $clientReviews trong resources/views/pages/home.blade.php.
 */
class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');

            // tên khách — không dịch
            $table->string('author_name', 120);
            $table->string('author_avatar_path', 255)->nullable();
            $table->string('author_country', 60)->nullable();

            $table->unsignedTinyInteger('rating')->default(5);

            $table->text('content_en')->nullable();
            $table->text('content_vi')->nullable();

            $table->enum('source', ['google', 'facebook', 'instagram', 'manual'])->default('manual');
            $table->string('source_url', 255)->nullable();

            // để render "2 tuần trước"
            $table->date('reviewed_at')->nullable();

            $table->unsignedInteger('artist_id')->nullable()->index();

            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->smallInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
