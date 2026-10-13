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
            $table->string('no_kp')->nullable()->after('email');
            $table->string('jantina')->nullable()->after('no_kp');
            $table->string('bangsa')->nullable()->after('jantina');
            $table->string('gred')->nullable()->after('job_description');
            $table->string('kumpulan')->nullable()->after('gred');
            $table->string('jabatan')->nullable()->after('kumpulan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'no_kp',
                'jantina',
                'bangsa',
                'gred',
                'kumpulan',
                'jabatan'
            ]);
        });
    }
};