<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ProjectTools\Repositories;

use App\User;
use Venturecraft\Revisionable\Revision;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ProjectTools\UserInterface;
use Illuminate\Support\Facades\Hash;
/**
 * Description of UserRepository
 *
 * @author kistha
 */
class UserRepository implements UserInterface {
    //put your code here
    
    public function getList($input) {
        if (!isset($input['o']) || $input['o'] == '')
            $input['o'] = 'users.id';
        if (!isset($input['d']) || $input['d'] == '')
            $input['d'] = 'ASC';
        
        $searchAttributes = addSearchAttributes($input);
        extract($searchAttributes);

        $query = User::select($columns)
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
        $inputs['password'] = Hash::make($inputs['password']);
        $query = User::create($inputs);
        return $query;
    }
    
    
    public function getById($id){
        $query = User::findOrFail($id);
        return $query;
    }
    
    public function update($id,$inputs=null){
        if(isset($inputs['password']))
            $inputs['password'] = Hash::make($inputs['password']);
        $query = User::findOrFail($id);
        $query->update($inputs);
        return $query;
    }
    
    public function delete($id){
        
    }
    
    public function searchField() {
        return [
            'role' => [
                'column' => 'users.role',
                'label' => 'Role',
                'type' => 'select',
                'options' => array_flip(getOptionKeyValue('roles')),
                'use_keys_for_values' => true,
                'columns'=>[ 'users.role'],
                'attr'=>[
                    'kp-bind'=>'select2'
                ]
            ],
//            'first_name' => [
//                'column' => 'users.first_name',
//                'label' => 'First Name',
//                'type' => 'text',
//            ],
//            'last_name' => [
//                'column' => 'users.last_name',
//                'label' => 'Last Name',
//                'type' => 'text',
//            ],
//            'email' => [
//                'column' => 'users.email',
//                'label' => 'Email',
//                'type' => 'text',
//            ],
        ];
    }
}
