<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 社員番号:(staff_id)　主キー兼外部キー
        // 出勤時間(attend_time)主キー
        // 退勤時間(leaving_work)
        Schema::create('attend_leave', function (Blueprint $table) {
            $table->unsignedBigInteger('staff_id')->unique();
            $table->date('work_date');//日付

            $table->time('attend_time');
            $table->time('leaving_work')->nullable();
            
            $table->primary(['staff_id','work_date']);
            $table->foreign('staff_id')->references('staff_id')->on('employee');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attend_leave');
    }
};
