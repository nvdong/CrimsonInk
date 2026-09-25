<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menu header và 2 cột link ở footer, có hỗ trợ menu con qua parent_id.
 * Thay cho link hardcode trong partials/header.blade.php và footer.blade.php.
 *
 * Ưu tiên route_name; chỉ dùng url khi trỏ ra ngoài site.
 */
class CreateMenuItemsTable extends Migration
{
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('location', ['header', 'footer_quick', 'footer_styles'])
                  ->default('header')
                  ->index();

            $table->unsignedInteger('parent_id')->nullable()->index();

            $table->string('label_en', 80);
            $table->string('label_vi', 80);

            $table->string('route_name', 120)->nullable();
            $table->string('url', 255)->nullable();
            $table->boolean('target_blank')->default(false);

            $table->boolean('is_active')->default(true)->index();
            $table->smallInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
