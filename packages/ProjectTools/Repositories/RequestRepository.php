<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ProjectTools\Repositories;

use App\User;
use App\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ProjectTools\RequestInterface;
use Mail;

/**
 * Description of RequestRepository
 *
 * @author kistha
 */
class RequestRepository implements RequestInterface {

    public $time_now = null;

    public function __construct() {
        $this->time_now = \Carbon\Carbon::now();
    }

    public function getList($input) {
        if (!isset($input['o']) || $input['o'] == '')
            $input['o'] = 'requests.req_no';
        if (!isset($input['d']) || $input['d'] == '')
            $input['d'] = 'DESC';

        $searchAttributes = addSearchAttributes($input);
        extract($searchAttributes);

        $query = Requests::select($columns)
                ->orderBy($orderBy, $order);

        if ($searchFilters) {
            $query = $query->whereRaw($searchFilters);
        }
        if ($raw_where) {
            $query = $query->whereRaw($raw_where);
        }
        if ($where) {
            $query->where($where);
        }
        if (isset($input['join']) and in_array('requester', $input['join'])){
            $query->leftJoin('users', 'users.email', '=', 'requests.requester');
        }
        if ($with_trash) {
            $query->withTrashed();
        }
//        dd($query->toSql());
        // Apply paginate
        if ($paginate) {
            return $query->paginate($page_limit);
        } elseif ($exportPaginate) {
            return $query->paginate(50);
        } elseif ($query_object) {
            return $query;
        } else
            return $query->get();
    }

    public function create($inputs) {
        $inputs = $this->fillInitialFields($inputs);
        $query = Requests::create($inputs);
        $action = ($query->status == Requests::STATUS_FAST_TRACK)?'fasttrack':'new';
        $message = (new \App\Mail\RequestStatusMailer($query,$action))
                ->onConnection('database')
                ->onQueue('emails');
        Mail::queue($message);
//        Mail::send(new \App\Mail\RequestStatusMailer($query,$action));
        return $query;
    }

    public function getById($id) {
        $query = Requests::findOrFail($id);
        return $query;
    }

//    public function update($id,$inputs=null){
//        $query = Requests::find($id);
//        $query->update($inputs);
//        return $query;
//    }

    public function delete($id) {
        
    }

    public function getNewRequestNumber() {
        $inputs['latest'] = Requests::max('id') + 1;
        $inputs['req_no'] = Requests::max('req_no') + 1;
        return $inputs;
    }

    private function fillInitialFields($inputs) {
        extract($this->getNewRequestNumber());
        $inputs['latest'] = $latest;
        $inputs['req_no'] = $req_no;
        $inputs['status'] = Requests::STATUS_NEW;
        $inputs['requester'] = auth()->user()->email;
        $inputs['submitted_date'] = $this->time_now;
        if (isset($inputs['fasttrack']) and $inputs['fasttrack'] == 'active') {
            $inputs['status'] = Requests::STATUS_FAST_TRACK;
            unset($inputs['fasttrack']);
        }
        return $inputs;
    }

    private function updatedInitialFields($request, $inputs) {
        extract($this->getNewRequestNumber());
        $inputs['latest'] = $latest;
        $inputs['req_no'] = $request->req_no;
        $inputs['status'] = Requests::STATUS_NEW;
        $inputs['requester'] = auth()->user()->email;
        $inputs['submitted_date'] = $this->time_now;
        $inputs['updated_comment'] = $this->_get_comment($inputs['updated_comment']);

        return $inputs;
    }

    public function actions($id, $action, $inputs = []) {
        switch ($action) {
            case 'cancel':
                $request = $this->cancel($id, $inputs);
                break;
            case 'update':
                $request = $this->update($id, $inputs);
                break;
            case 'reject':
                $request = $this->reject($id, $inputs);
                break;
            case 'more-info':
                $request = $this->more_info($id, $inputs);
                break;
            case 'accept':
                $request = $this->accept($id, $inputs);
                break;
            case 'analysed':
                $request = $this->analysed($id, $inputs);
                break;
            case 'costed':
                $request = $this->costed($id, $inputs);
                break;
            case 'scheduled':
                $request = $this->scheduled($id, $inputs);
                break;
            case 'approved':
                $request = $this->approved($id, $inputs);
                break;
            case 'implemented':
                $request = $this->implemented($id, $inputs);
                break;
            case 'rework':
                $request = $this->rework($id, $inputs);
                break;
            case 'moretime':
                $request = $this->moretime($id, $inputs);
                break;
            case 'backout':
                $request = $this->backout($id, $inputs);
                break;
            case 'backedout':
                $request = $this->backedout($id, $inputs);
                break;
            case 'pass':
                $request = $this->pass($id, $inputs);
                break;
            case 'fail':
                $request = $this->fail($id, $inputs);
                break;
            case 'reopen':
                $request = $this->reopen($id, $inputs);
                break;
            default:
                throw new \Exception('Request action undefined.');
                break;
        }
        $message = (new \App\Mail\RequestStatusMailer($request,$action))
                ->onConnection('database')
                ->onQueue('emails');
        Mail::queue($message);
        return $request;
    }

    protected function _get_comment($message) {
        return $this->time_now . " - " . auth()->user()->email . "\n" . $message;
    }

    protected function cancel($id, $inputs) {
        $request = $this->getById($id);
        $request->update([
            'cancelled_comment' => $this->_get_comment($inputs['cancelled_comment']),
            'cancelled_date' => \Carbon\Carbon::now(),
            'status' => Requests::STATUS_CANCEL
        ]);
        return $request;
    }

    protected function reject($id, $inputs) {
        $request = $this->getById($id);
        $request->update([
            'rejected_comment' => $this->_get_comment($inputs['rejected_comment']),
            'rejected_date' => $this->time_now,
            'status' => Requests::STATUS_REJECT
        ]);
        return $request;
    }

    protected function accept($id, $inputs) {
        $request = $this->getById($id);
        $request->update([
            'accepted_comment' => $this->_get_comment($inputs['accepted_comment']),
            'accepted_date' => $this->time_now,
            'status' => Requests::STATUS_ACCEPT
        ]);
        return $request;
    }

    protected function more_info($id, $inputs) {
        $request = $this->getById($id);
        $request->update([
            'more_info_comment' => $this->_get_comment($inputs['more_info_comment']),
            'more_info_date' => $this->time_now,
            'status' => Requests::STATUS_MOREINFO
        ]);
        return $request;
    }
    protected function analysed($id, $inputs) {
        $inputs['skills'] = array_filter($inputs['skills']);
        $inputs['manpower_cost'] = $this->man_power_cost($inputs['skills']);
        $request = $this->getById($id);
        $request->update([
            'analysed_comment' => $this->_get_comment($inputs['analysed_comment']),
            'analysed_date' => $this->time_now,
            'status' => Requests::STATUS_ANALYSED,
            'req_type' => $inputs['req_type'],
            'soln' => $inputs['soln'],
            'skills' => $inputs['skills'],
            'capex_comment' => $inputs['capex_comment'],
            'capex_cost' => $inputs['capex_cost'],
            'ext_interfaces'=> $inputs['ext_interfaces'],
            'approach' => $inputs['approach'],
            'backout_method' => $inputs['backout_method'],
            'manpower_cost'=>$inputs['manpower_cost']
        ]);
        return $request;
    }

    protected function costed($id, $inputs) {
        $manpower_cost = $inputs["manpower_cost"];
	$capex_cost = $inputs["capex_cost"];
	$add_cost = $inputs["add_cost"];
	$tot_cost = $manpower_cost + $capex_cost + $add_cost;
        $request = $this->getById($id);
        $request->update([
            'costs' =>$inputs['costs'],
            'costed_comment'=> $this->_get_comment($inputs['costed_comment']),
            'costed_date' => $this->time_now,
            'add_cost' => $add_cost,
            'tot_cost' => $tot_cost,
            'status' => Requests::STATUS_COSTED
        ]);
        return $request;
    }
    
    protected function scheduled($id, $inputs) {
	$request = $this->getById($id);
        $request->update([
            'planned_start' =>$inputs['planned_start'],
            'planned_finish' =>$inputs['planned_finish'],
            'scheduled_comment'=> $this->_get_comment($inputs['scheduled_comment']),
            'scheduled_date' => $this->time_now,
            'status' => Requests::STATUS_SCHEDULE
        ]);
        return $request;
    }
    
    protected function approved($id, $inputs) {
	$request = $this->getById($id);
        $request->update([
            'approved_comment'=> $this->_get_comment($inputs['approved_comment']),
            'approved_date' => $this->time_now,
            'status' => Requests::STATUS_APPROVED
        ]);
        return $request;
    }
    
    protected function implemented($id, $inputs) {
	$request = $this->getById($id);
        $request->update([
            'implemented_comment'=> $this->_get_comment($inputs['implemented_comment']),
            'implemented_date' => $this->time_now,
            'status' => Requests::STATUS_IMPLEMENTED
        ]);
        return $request;
    }
    
    protected function rework($id, $inputs) {
	$request = $this->getById($id);
        $request->update([
            'rework_comment'=> $this->_get_comment($inputs['rework_comment']),
            'rework_date' => $this->time_now,
            'status' => Requests::STATUS_REWORKING
        ]);
        return $request;
    }
    
    protected function moretime($id, $inputs) {
	$request = $this->getById($id);
        $request->update([
            'more_time_comment'=> $this->_get_comment($inputs['more_time_comment']),
            'more_time_date' => $this->time_now,
            'status' => Requests::STATUS_MORETIME
        ]);
        return $request;
    }
    
    protected function backout($id, $inputs) {
	$request = $this->getById($id);
        $request->update([
            'backout_comment'=> $this->_get_comment($inputs['backout_comment']),
            'backout_date' => $this->time_now,
            'status' => Requests::STATUS_BACKINGOUT
        ]);
        return $request;
    }
    
    protected function backedout($id, $inputs) {
	$request = $this->getById($id);
        $request->update([
            'backedout_comment'=> $this->_get_comment($inputs['backedout_comment']),
            'backedout_date' => $this->time_now,
            'status' => Requests::STATUS_BACKEDOUT
        ]);
        return $request;
    }
    
    protected function pass($id, $inputs) {
	$request = $this->getById($id);
        $request->update([
            'testresults'=> $inputs['testresults'],
            'testresults_date' => $this->time_now,
            'status' => Requests::STATUS_COMPLETED
        ]);
        return $request;
    }
    
    protected function fail($id, $inputs) {
	$request = $this->getById($id);
        $request->update([
            'testresults'=> $inputs['testresults'],
            'testresults_date' => $this->time_now,
            'status' => Requests::STATUS_FAILTESTING
        ]);
        return $request;
    }
    
    protected function reopen($id, $inputs) {
	$request = $this->getById($id);
        $request->update([
            'reopened_comment'=> $this->_get_comment($inputs['reopened_comment']),
            'reopened_date' => $this->time_now,
            'status' => Requests::STATUS_REOPEN
        ]);
        return $request;
    }
    
    public function update($id, $inputs = null) {
        $request = $this->getById($id);
        $data = $this->updatedInitialFields($request, $inputs);
        $new_request = Requests::create($data);
        Requests::where('req_no', '=', $request->req_no)
                ->update(['latest' => $new_request->id]);
        return $new_request;
    }
    
    public function man_power_cost($skills = []) {
        $db_skills = getDbDropDown('resources','price','abbrv');
        $manpower_cost = null;
        foreach ($skills as $skill => $res_qty) {
            if ($res_qty and isset($db_skills[$skill])) {        //	if the skill is being used
                $manpower_cost += $res_qty * $db_skills[$skill];    //	multiply the resourceQty by the resource cost
            }
        }
        return $manpower_cost;
    }
    
    public function searchField() {
        return [
            'requester' => [
                'column' => 'requests.requester',
                'label' => 'Requester',           
                'type' => 'select',
                'options' => getDbDropDown('user', 'display_names', 'email', $options = [
                    'select' => "email,CONCAT(first_name,' ',last_name) as display_names"
                ]),
                'use_keys_for_values' => true,
                'attr'=>[
                    'kp-bind'=>'select2'
                ]
            ],
            'status' => [
                'column' => 'requests.status',
                'label' => 'Status',
                'type' => 'select',
                'options'=>[
                    'Accepted'=>'Accepted',
                    'Analysed'=>'Analysed',
                    'Approved'=>'Approved',
                    'Backed Out'=>'Backed Out',
                    'Backing Out'=>'Backing Out',
                    'Cancelled'=>'Cancelled',
                    'Completed'=>'Completed',
                    'Costed'=>'Costed',
                    'Failed Testing'=>'Failed Testing',
                    'Fast Tracked'=>'Fast Tracked',
                    'Implemented'=>'Implemented',
                    'More Info'=>'More Info',
                    'More Time'=>'More Time',
                    'New'=>'New',
                    'Rejected'=>'Rejected',
                    'Reopened'=>'Reopened',
                    'Reworking'=>'Reworking',
                    'Scheduled'=>'Scheduled',
                ]
            ],
            'before-start' => [
                'column' => 'requests.planned_start',
                'label' => 'Start Before',
                'type' => 'date',
                'class' => 'datepicker',
                'attr'=>[
                    'data-format'=>'YYYY-MM-DD'
                ]
            ],
            'after-start' => [
                'column' => 'requests.planned_start',
                'label' => 'Start After',
                'type' => 'date',
                'class' => 'datepicker',
                'attr'=>[
                    'data-format'=>'YYYY-MM-DD'
                ]
            ],
            'before-finish' => [
                'column' => 'requests.planned_finish',
                'label' => 'Finish Before',
                'type' => 'date',
                'class' => 'datepicker',
                'attr'=>[
                    'data-format'=>'YYYY-MM-DD'
                ]
            ],
            'after-finish' => [
                'column' => 'requests.planned_finish',
                'label' => 'Finish After',
                'type' => 'date',
                'class' => 'datepicker',
                'attr'=>[
                    'data-format'=>'YYYY-MM-DD'
                ]
            ]
        ];
    }
}
