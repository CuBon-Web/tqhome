<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductProfileDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('product_profile_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title')->default('');
            $table->text('images')->nullable();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->index('category_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_profile_documents');
    }
}
