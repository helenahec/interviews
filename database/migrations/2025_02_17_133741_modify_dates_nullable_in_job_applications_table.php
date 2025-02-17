<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->date('interview_date')->nullable()->change();
            $table->date('next_date')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->date('interview_date')->nullable(false)->change();
            $table->date('next_date')->nullable(false)->change();
        });
    }
};

