<?php

use Illuminate\Database\Seeder;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
	DB::table('requests')->insert([
		'id' => '1', 
		'req_no' => '1', 
		'latest' => '1', 
		'title' => 'Implement Project Tools', 
		'submitted_date' => date("Y-m-d H:i:s", strtotime("-14 days")), 
		'requester' => 'mark.smith@project-tools.co.uk', 
		'description' => 'Implement Project-Tools work management system and philosophy.', 
		'justification' => 'Transparent online work management system defining approved work.', 
		'deliverables' => 'System implemented with initial seed data and users trained to utilise the system.', 
		'criteria' => 'Stakeholders utilisation of the system, showing agreed work requests, resources and actions.', 
		'required_date' => date("Y-m-d H:i:s"), 
		'status' => 'Completed', 
		'accepted_date' => date("Y-m-d H:i:s", strtotime("-13 days")), 
		'accepted_comment' => date("Y-m-d H:i:s", strtotime("-13 days")) . ' - mark.smith@project-tools.co.uk ', 
		'more_info_date' => NULL, 
		'more_info_comment' => NULL, 
		'rejected_date' => NULL, 
		'rejected_comment' => NULL, 
		'fasttrack_comment' => NULL, 
		'req_type' => 'new', 
		'soln' => 'Systems Administrator implement system, defining users and resources to allow the ongoing use by specified sakeholders.', 
		'skills' => 'SPM=3,DBA=1,SA=2,TA=2', 
		'capex_comment' => 'Hosting, SSL', 
		'capex_cost' => '50', 
		'ext_interfaces' => '', 
		'approach' => 'System implmented on LAMP stack according to deployment guide, OR, bought SAAS.', 
		'backout_method' => 'Cancel and stop working on the project.', 
		'manpower_cost' => '5250', 
		'costs' => NULL, 
		'add_cost' => '0', 
		'tot_cost' => '5300', 
		'planned_start' => date("Y-m-d", strtotime("-8 days")), 
		'planned_finish' => date("Y-m-d"), 
		'analysed_date' => date("Y-m-d H:i:s", strtotime("-12 days")), 
		'analysed_comment' => date("Y-m-d H:i:s", strtotime("-12 days")) . ' - mark.smith@project-tools.co.uk ', 
		'costed_date' => date("Y-m-d H:i:s", strtotime("-11 days")), 
		'costed_comment' => date("Y-m-d H:i:s", strtotime("-11 days")) . ' - mark.smith@project-tools.co.uk', 
		'scheduled_date' => date("Y-m-d H:i:s", strtotime("-10 days")), 
		'scheduled_comment' => date("Y-m-d H:i:s", strtotime("-10 days")) . ' - mark.smith@project-tools.co.uk ', 
		'approved_date' => date("Y-m-d H:i:s", strtotime("-9 days")), 
		'approved_comment' => date("Y-m-d H:i:s", strtotime("-9 days")) . ' - mark.smith@project-tools.co.uk ', 
		'implemented_date' => date("Y-m-d H:i:s"), 
		'implemented_comment' => 'System implmented, fully tested and stakeholders trained.', 
		'testresults_date' => date("Y-m-d H:i:s"), 
		'testresults' => 'System successfully demo\'d to all stakeholders who deemed the demo/test as passed.', 
		'backout_date' => NULL, 
		'backout_comment' => NULL, 
		'cancelled_date' => NULL, 
		'cancelled_comment' => NULL, 
		'reopened_date' => NULL, 
		'reopened_comment' => NULL, 
		'rework_date' => NULL, 
		'rework_comment' => NULL, 
		'more_time_date' => NULL, 
		'more_time_comment' => NULL, 
		'backedout_date' => NULL, 
		'backedout_comment' => NULL, 
		'updated_comment' => NULL, 
		'deleted_at' => NULL, 
		'created_at' => date("Y-m-d H:i:s", strtotime("-14 days")), 
		'updated_at' => date("Y-m-d H:i:s")
	]);
	}
}
