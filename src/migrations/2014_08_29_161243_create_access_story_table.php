<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Samcrosoft\Accesstory\Config\Reader;

class CreateAccessStoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $sTable = Reader::getTableName();

        Schema::dropIfExists($sTable);
        Schema::create($sTable, function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('ip_address', 100)->nullable();
            $table->string('domain', 500)->nullable();
            $table->string('path', 500)->nullable();
            $table->string('request_method', 500)->nullable();
            $table->string('query_string', 500)->nullable();
            $table->text('post_string')->nullable();
            $table->boolean('is_ajax')->default(0);
            $table->boolean('is_secure')->default(0);
            $table->string('route_uri', 400)->nullable();
            $table->string('route_name', 400)->nullable();
            $table->string('route_action', 400)->nullable();
            $table->string('class_controller', 400)->nullable();
            $table->string('class_method', 400)->nullable();
            $table->float('response_time', 12, 6)->nullable();
            $table->bigInteger('memory_usage')->nullable();
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
        $sTable = Reader::getTableName();
        Schema::dropIfExists($sTable);
	}

}
