<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ProjectTools\Repositories;

use App\User;
use App\Resources;
use Illuminate\Database\Eloquent\ModelNotFoundException;
/**
 * Description of ResourceRepository
 *
 * @author kistha
 */
class ResourceRepository  implements \ProjectTools\ResourceInterface{
    //put your code here
    public function getList($inputs){
        if (!isset($inputs['o']) || $inputs['o'] == '')
            $inputs['o'] = 'resources.id';
        if (!isset($inputs['d']) || $inputs['d'] == '')
            $inputs['d'] = 'ASC';

        $searchAttributes = addSearchAttributes($inputs);
        extract($searchAttributes);

        $query = Resources::select($columns);
        $query = $query->orderBy($orderBy, $order);
        
        if ($searchFilters) {
            $query->whereRaw($searchFilters);
        }
        if ($where) {
            $query->where($where);
        }
        if ($with_trash) {
            $query->withTrashed();
        }
        if ($paginate) {
            return $query->paginate($page_limit);
        } elseif ($exportPaginate) {
            return $query->paginate(50);
        } elseif ($query_object) {
            return $query;
        } else
            return $query->get();
    }
    public function searchField(){
        return [];
    }
    public function create($inputs){
        $query = Resources::create($inputs);
        return $query;
    }
    
    
    public function getById($id){
        $query = Resources::findOrFail($id);
        return $query;
    }
    
    public function update($id,$inputs=null){
        $query = Resources::findOrFail($id);
        $query->update($inputs);
        return $query;
    }

}
