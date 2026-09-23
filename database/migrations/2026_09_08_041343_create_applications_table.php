<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {


            $table->id();


            /*
             * Application display name
             */
            $table->string('name');


            /*
             * Short code
             * Example:
             * cme
             * ir
             * imonitor
             */
            $table->string('code')
                  ->unique();


            /*
             * Description shown on dashboard
             */
            $table->text('description')
                  ->nullable();


            /*
             * Server hosting the application
             */
            $table->string('server_ip')->nullable();

            /*
             * Application URL
             */
            $table->string('url')->nullable();
            

            /*
             * Icon / emoji
             */
            $table->text('icon')
                  ->nullable();


            /*
             * Display control
             */
            $table->boolean('active')
                  ->default(true);


            /*
             * Future AD group control
             */
            $table->string('required_group')
                  ->nullable();


            /*
             * SSO method
             * token / oauth / saml
             */
            $table->string('sso_type')
                  ->default('token');


            $table->timestamps();

        });
    }



    public function down(): void
    {
        Schema::dropIfExists('applications');
    }

};