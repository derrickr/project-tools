<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ProjectTools\Repositories;

use App\User;
use App\Actions;
use Venturecraft\Revisionable\Revision;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ProjectTools\ActionInterface;
/**
 * Description of UserRepository
 *
 * @author kistha
 */
class ActionRepository implements ActionInterface {
    //put your code here
    
    public function getList($input) {
        if (!isset($input['o']) || $input['o'] == '')
            $input['o'] = 'actions.id';
        if (!isset($input['d']) || $input['d'] == '')
            $input['d'] = 'DESC';
        
        $searchAttributes = addSearchAttributes($input);
        extract($searchAttributes);

        $query = Actions::select($columns)
                ->orderBy($orderBy, $order);
        
        if ($searchFilters) {
            $query = $query->whereRaw($searchFilters);
        }
        if ($where) {
            $query->where($where);
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
    public function create($inputs){
        $inputs['target_date'] = $this->getDateFormated($inputs['target_date']);
        $inputs['target_duration'] = ceil(((strtotime($inputs['target_date'])) - (strtotime(date("Y-m-d")))) / 86400);
        $inputs['status'] = Actions::ACTION_OPEN;
        $inputs['identified'] = date("Y-m-d H:i:s");
        
        $query = Actions::create($inputs);
        return $query;
    }
    
    
    public function getById($id){
        $query = Actions::findOrFail($id);
        return $query;
    }
    
    public function getDateFormated($input){
        $date = str_replace('/', '-', $input);
        return date('Y-m-d', strtotime($date));
    }
    public function update($id,$inputs=null){
        $completed2 = NULL;
        $identified = $inputs['identified'];
        $date = date("Y-m-d");

        if($inputs['completed']){
            $completed =  $this->getDateFormated($inputs['completed']);
            $inputs['status'] = Actions::ACTION_CLOSE;
		if($completed == $date){ //if completed today then also set current time
			$completed2 = date("Y-m-d H:i:s");
		}
		if($completed < $date){
			$completed2 = $completed;
		}
		$inputs['actual_duration'] = floor((strtotime(substr($completed, 0, 10)) - strtotime(substr($identified, 0, 10))) / 86400);
	} else {
		$inputs['status'] = Actions::ACTION_OPEN;
	}
        $inputs['completed'] = $completed2;
        $query = Actions::findOrFail($id);

        $query->update($inputs);
        return $query;
    }
    
    public function delete($id){
        
    }
    
    public function searchField() {
        return [
            'owner' => [
                'column' => 'actions.owner',
                'label' => 'Owner',
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
                'column' => 'actions.status',
                'label' => 'Status',
                'type' => 'select',
                'options'=>[
                    'Closed'=>'Closed',
                    'Open'=>'Open'
                ]
            ],
            'before-completed' => [
                'column' => 'actions.completed',
                'label' => 'Completed Before',
                'type' => 'date',
                'class' => 'datepicker',
                'attr'=>[
                    'data-format'=>'YYYY-MM-DD'
                ]
            ],
            'after-completed' => [
                'column' => 'actions.completed',
                'label' => 'Completed After',
                'type' => 'date',
                'class' => 'datepicker',
                'attr'=>[
                    'data-format'=>'YYYY-MM-DD'
                ]
            ]
        ];
    }
}
