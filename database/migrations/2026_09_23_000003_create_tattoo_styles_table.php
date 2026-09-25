<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Phong cách xăm — carousel trang chủ, trang /tattoo-styles và các trang con.
 * Thay cho mảng $tattooStyles trong resources/views/pages/home.blade.php.
 *
 * has_detail_page = false  ->  thẻ trong carousel trỏ về /tattoo-styles
 */
class CreateTattooStylesTable extends Migration
{
    public function up()
    {
        Schema::create('tattoo_styles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 120)->unique();

            $table->string('name_en', 120);
            $table->string('name_vi', 120);
            $table->string('excerpt_en', 255)->nullable();
            $table->string('excerpt_vi', 255)->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_vi')->nullable();

            $table->string('cover_path', 255)->nullable();

            $table->boolean('has_detail_page')->default(false);
            $table->string('route_name', 120)->nullable();

            $table->string('meta_title_en', 190)->nullable();
            $table->string('meta_title_vi', 190)->nullable();
            $table->string('meta_description_en', 300)->nullable();
            $table->string('meta_description_vi', 300)->nullable();

            $table->boolean('is_featured')->default(true)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->smallInteger('sort_order')->default(0)->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tattoo_styles');
    }
}
