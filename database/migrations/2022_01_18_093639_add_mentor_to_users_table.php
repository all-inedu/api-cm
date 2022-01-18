<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMentorToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('exp_mentor_id')->nullable();
            $table->string('exp_mentor_name')->nullable();
            $table->string('exp_mentor_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('exp_mentor_id');
            $table->dropColumn('exp_mentor_name');
            $table->dropColumn('exp_mentor_email');
        });
    }
}
