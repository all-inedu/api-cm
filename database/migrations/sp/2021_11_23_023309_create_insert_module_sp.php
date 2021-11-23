<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsertModuleSp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure = "DROP PROCEDURE IF EXISTS `insert_module`;
                CREATE PROCEDURE `insert_module` (
                    IN in_module_name varchar(255),
                    IN in_desc text,
                    IN in_category varchar(255),
                    IN in_price varchar(255),
                    IN in_status tinyint
                    )
                BEGIN
                    INSERT INTO modules(`module_name`, `desc`, `category`, `price`, `status`, `created_at`, `updated_at`) 
                    VALUES (in_module_name, in_desc, in_category, in_price, in_status, NOW(), NOW());
                END;";

                \DB::unprepared($store_procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insert_module_sp');
    }
}
