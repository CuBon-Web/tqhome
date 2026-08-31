<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHistoryMilestonesTable extends Migration
{
    public function up()
    {
        Schema::create('history_milestones', function (Blueprint $table) {
            $table->id();
            $table->string('year', 50)->default('');
            $table->string('title')->default('');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        $now = now();
        DB::table('history_milestones')->insert([
            [
                'year' => '2004',
                'title' => 'KHỞI ĐẦU',
                'description' => 'Bắt đầu kinh doanh kim khí và điện nước, phục vụ nhu cầu thiết yếu của khách hàng địa phương.',
                'sort' => 1,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'year' => '2010',
                'title' => 'MỞ RỘNG NGÀNH HÀNG',
                'description' => 'Đa dạng thêm vật tư điện nước, thiết bị vệ sinh, sen vòi và các sản phẩm phục vụ công trình.',
                'sort' => 2,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'year' => '2016',
                'title' => 'PHÁT TRIỂN QUY MÔ',
                'description' => 'Tăng cường phục vụ thợ, nhà thầu, công trình và xây dựng mạng lưới khách hàng lâu dài.',
                'sort' => 3,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'year' => '2024 →',
                'title' => 'TQHOME HÔM NAY',
                'description' => 'Tiếp tục mở rộng danh mục với định hướng “buôn cái gì cũng có”, lấy uy tín và dịch vụ làm nền tảng.',
                'sort' => 4,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('history_milestones');
    }
}
