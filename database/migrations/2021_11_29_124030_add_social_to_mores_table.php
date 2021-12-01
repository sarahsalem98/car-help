<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialToMoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mores', function (Blueprint $table) {
            $table->string('facebook')->nullable()->after('who_are_we');
            $table->string('twitter')->nullable()->after('who_are_we');
            $table->string('youtube')->nullable()->after('who_are_we');
            $table->string('google')->nullable()->after('who_are_we');
            $table->string('phone')->nullable()->after('who_are_we');
            $table->string('location')->nullable()->after('who_are_we');
            $table->string('email')->nullable()->after('who_are_we');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mores', function (Blueprint $table) {
            //
        });
    }
}
