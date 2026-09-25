<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Câu hỏi thường gặp — dùng cho trang booking và để gắn schema FAQPage.
 * CSS accordion của Elementor đã nạp sẵn nên không cần thêm asset.
 */
class CreateFaqsTable extends Migration
{
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');

            // booking | aftercare | pricing
            $table->string('group', 40)->default('booking')->index();

            $table->string('question_en', 255);
            $table->string('question_vi', 255);
            $table->text('answer_en')->nullable();
            $table->text('answer_vi')->nullable();

            $table->boolean('is_active')->default(true)->index();
            $table->smallInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faqs');
    }
}
