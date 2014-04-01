<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiKeysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apiKeys', function($table) {
                $table->integer('keyID')->primary();
				$table->string('vCode', 256);
                $table->string('username', 32);
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
		Schema::drop('apiKeys');
	}

}
