<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('req_no');
			$table->integer('latest');
			$table->string('title', 191);
			$table->dateTime('submitted_date')->nullable();
			$table->string('requester', 191);
			$table->text('description', 16777215)->nullable();
			$table->text('justification', 16777215)->nullable();
			$table->text('deliverables', 16777215)->nullable();
			$table->text('criteria', 16777215)->nullable();
			$table->date('required_date')->nullable();
			$table->string('status', 191);
			$table->dateTime('accepted_date')->nullable();
			$table->text('accepted_comment', 16777215)->nullable();
			$table->dateTime('more_info_date')->nullable();
			$table->text('more_info_comment', 16777215)->nullable();
			$table->dateTime('rejected_date')->nullable();
			$table->text('rejected_comment', 16777215)->nullable();
			$table->text('fasttrack_comment', 16777215)->nullable();
			$table->string('req_type', 191);
			$table->text('soln', 16777215);
			$table->text('skills', 16777215)->nullable();
			$table->text('capex_comment', 16777215)->nullable();
			$table->decimal('capex_cost', 10, 0);
			$table->text('ext_interfaces', 16777215);
			$table->text('approach', 16777215)->nullable();
			$table->text('backout_method', 16777215)->nullable();
			$table->decimal('manpower_cost', 10, 0)->nullable();
			$table->text('costs', 16777215)->nullable();
			$table->decimal('add_cost', 10, 0);
			$table->decimal('tot_cost', 10, 0)->nullable();
			$table->date('planned_start')->nullable();
			$table->date('planned_finish')->nullable();
			$table->dateTime('analysed_date')->nullable();
			$table->text('analysed_comment', 16777215)->nullable();
			$table->dateTime('costed_date')->nullable();
			$table->text('costed_comment', 16777215)->nullable();
			$table->dateTime('scheduled_date')->nullable();
			$table->text('scheduled_comment', 16777215)->nullable();
			$table->dateTime('approved_date')->nullable();
			$table->text('approved_comment', 16777215)->nullable();
			$table->dateTime('implemented_date')->nullable();
			$table->text('implemented_comment', 16777215)->nullable();
			$table->dateTime('testresults_date')->nullable();
			$table->text('testresults', 16777215)->nullable();
			$table->dateTime('backout_date')->nullable();
			$table->text('backout_comment', 16777215)->nullable();
			$table->dateTime('cancelled_date')->nullable();
			$table->text('cancelled_comment', 16777215)->nullable();
			$table->dateTime('reopened_date')->nullable();
			$table->text('reopened_comment', 16777215)->nullable();
			$table->dateTime('rework_date')->nullable();
			$table->text('rework_comment', 16777215)->nullable();
			$table->dateTime('more_time_date')->nullable();
			$table->text('more_time_comment', 16777215)->nullable();
			$table->dateTime('backedout_date')->nullable();
			$table->text('backedout_comment', 16777215)->nullable();
			$table->text('updated_comment', 16777215)->nullable();
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
		Schema::drop('requests');
	}

}
