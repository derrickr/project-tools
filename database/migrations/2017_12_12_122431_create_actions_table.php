<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('description', 191)->nullable();
			$table->text('owner', 16777215)->nullable();
			$table->dateTime('identified')->nullable();
			$table->date('target_date')->nullable();
			$table->dateTime('completed')->nullable();
			$table->text('status', 16777215)->nullable();
			$table->text('comment', 16777215)->nullable();
			$table->integer('target_duration')->nullable();
			$table->integer('actual_duration')->nullable();
			$table->softDeletes();
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
		Schema::drop('actions');
	}

}
