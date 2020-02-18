<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class CreateRequestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Request related
            $table->enum('method', [
                'GET',
                'HEAD',
                'POST',
                'PUT',
                'DELETE',
                'CONNECT',
                'OPTIONS',
                'TRACE',
                'PATCH'
            ]);
            
            $table->string('path');
            $table->string('query_string')->nullable()->default(null);
            $table->json('body')->nullable()->default(null);
            $table->string('referrer')->nullable()->default(null);
            $table->string('user_agent');
            $table->json('headers')->nullable()->default(null);

            // Can be changes to varbinary(16) or other field suited for IP like "inet" in postgres
            // Now is simple varchar
            $table->ipAddress('ip');

            // IP Geolocation related
            $table->string('country_code')->nullable()->default(null);
            $table->string('region')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->decimal('latitude', 11, 8)->nullable()->default(null);
            $table->string('longitude', 11, 8)->nullable()->default(null);

            // User related
            $table->string('user_type')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);

            // Custom/other
            $table->json('custom_attributes')->nullable()->default(null);

            // Date
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_logs');
    }
}
