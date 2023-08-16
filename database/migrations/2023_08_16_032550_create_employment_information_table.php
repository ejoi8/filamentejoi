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
        Schema::create('employment_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('job_title');
            $table->string('department');
            $table->date('date_of_joining');
            $table->string('employment_status');
            $table->string('work_location');
            $table->decimal('base_salary', 10, 2);
            $table->decimal('bonuses', 10, 2);
            $table->decimal('allowances', 10, 2);
            // ... other columns ...
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_information');
    }
};
