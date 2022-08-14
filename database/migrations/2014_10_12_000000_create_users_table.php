<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('customerType');

            $table->string('authCode')->nullable();
            $table->string('certificateType')->nullable();
            $table->string('certificateFile')->nullable();
            $table->string('resaleCertificateFile')->nullable();


            $table->string('hcpType')->nullable();
            $table->boolean('resale')->default(false);
            $table->string('hcpLegalBusinessName')->nullable();
            $table->string('hcpEin')->nullable();
            $table->string('hcpSpecialty')->nullable();
            $table->string('hcpAddress')->nullable();
            $table->string('hcpSuite')->nullable();
            $table->string('hcpCity')->nullable();
            $table->string('hcpPostcode')->nullable();
            $table->string('hcpCountry')->nullable();
            $table->string('hcpState')->nullable();
            $table->string('hcpPhoneNumber')->nullable();
            $table->string('hcpStatus')->default('Pending');
            $table->string('shippingType')->nullable();
            $table->string('resaleAgreementAccepted')->nullable();
            $table->string('resaleAgreementAcceptedVersion')->nullable();

            $table->boolean('isVerified')->default(false);
            $table->boolean('isEmployee')->default(false);

            $table->boolean('isAdmin')->default(false);
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
