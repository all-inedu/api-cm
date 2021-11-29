<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsertTElementSp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $store_procedure = "
                DROP PROCEDURE IF EXISTS `insert_t_element`;
                CREATE PROCEDURE `insert_t_element` (
                    IN in_part_id bigint,
                    IN in_category_element varchar(255),
                    IN in_description text,
                    IN in_video_link text,
                    IN in_image_path text,
                    IN in_question text,
                    IN in_total_point int,
                    IN in_order tinyint,
                    IN in_group int
                )
                BEGIN
                    BEGIN TRANSACTION;
                    SAVE TRANSACTION AddElement;
                    BEGIN TRY
                        SET @elementId = '';
                        INSERT INTO `elements`(`part_id`, `category_element`, `description`, `video_link`, `image_path`, `question`, `total_point`, `order`, `group`, `created_at`, `updated_at`) 
                        VALUES (in_part_id, in_category_element, in_description, in_video_link, in_image_path, in_question, in_total_point, in_order, in_group, CURDATE(), CURDATE())

                        SELECT LAST_INSERT_ID() INTO @elementId;
                    END TRY
                END;";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insert_t_element_sp');
    }
}
