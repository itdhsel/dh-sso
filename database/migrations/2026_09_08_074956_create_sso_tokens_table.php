<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sso_tokens', function (Blueprint $table) {

            $table->id();


            /*
             * Random secure token
             */
            $table->string('token')
                  ->unique();


            /*
             * Laravel authenticated user
             */
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();


            /*
             * Target application
             *
             * Example:
             * cme
             * ir
             * imonitor
             */
            $table->string('application_code');


            /*
             * Token expiry
             */
            $table->timestamp('expires_at');


            $table->timestamps();

        });
    }



    public function down(): void
    {
        Schema::dropIfExists('sso_tokens');
    }

};