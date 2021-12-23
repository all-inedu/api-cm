<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $view = "DROP VIEW IF EXISTS `answer_detail`;
                CREATE VIEW answer_detail AS
                SELECT a.*, e.answer as answer_from_multiple FROM `answers` a 
                left join element_details e on e.id = a.element_detail_id;";

        \DB::unprepared($view);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_detail');
    }
}
