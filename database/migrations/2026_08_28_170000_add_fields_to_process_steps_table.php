<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProcessStepsTable extends Migration
{
    public function up()
    {
        Schema::table('process_steps', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('title');
            $table->text('checklist')->nullable()->after('description');
            $table->string('link')->nullable()->after('checklist');
        });
    }

    public function down()
    {
        Schema::table('process_steps', function (Blueprint $table) {
            $table->dropColumn(['icon', 'checklist', 'link']);
        });
    }
}
