<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessPageSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('process_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->default('Quy trình cung ứng');
            $table->text('intro_content')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('commitment_title')->default('Cam kết của Kỳ Linh Food');
            $table->string('commitment_image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('process_page_settings');
    }
}
