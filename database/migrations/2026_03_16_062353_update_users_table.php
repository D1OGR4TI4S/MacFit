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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable();
            $table->string('gym_location')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('gym_location');
            $table->dropColumn('gender');
            $table->dropColumn('dob');
        });
    }
};
