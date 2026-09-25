<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kho ảnh/video dùng chung theo quan hệ đa hình.
 *
 * mediable_type : App\Artist | App\TattooStyle | App\Page
 * collection    : gallery | portfolio | before_after
 * path          : file cục bộ, đường dẫn tương đối từ public/
 *                 (asset của theme: assets/images/... — ảnh admin upload: upload/...)
 * embed_url     : dùng khi type = embed (YouTube/Vimeo)
 */
class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');

            $table->string('mediable_type', 120);
            $table->unsignedInteger('mediable_id');
            $table->string('collection', 40)->default('gallery');

            $table->enum('type', ['image', 'video', 'embed'])->default('image');

            $table->string('path', 255)->nullable();
            $table->string('poster_path', 255)->nullable();
            $table->string('embed_url', 255)->nullable();

            $table->string('alt_en', 190)->nullable();
            $table->string('alt_vi', 190)->nullable();
            $table->string('caption_en', 255)->nullable();
            $table->string('caption_vi', 255)->nullable();

            // đặt sẵn để tránh layout shift khi render
            $table->unsignedSmallInteger('width')->nullable();
            $table->unsignedSmallInteger('height')->nullable();
            $table->unsignedInteger('duration_seconds')->nullable();

            // quan hệ ngầm, chỉ index — không có FK constraint
            $table->unsignedInteger('tattoo_style_id')->nullable()->index();
            $table->unsignedInteger('artist_id')->nullable()->index();

            $table->boolean('is_active')->default(true);
            $table->smallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['mediable_type', 'mediable_id', 'collection'], 'media_mediable_collection_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
}
