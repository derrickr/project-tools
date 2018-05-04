<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ProjectTools\Repositories;

/**
 * Description of BaseRepository
 *
 * @author kevpat
 */
class BaseRepository {
    //put your code here
    
    protected $date_fields = ['target_date','required_date','planned_start','planned_finish'];
    protected $datetime_fields = ['last_visit','identified','completed','approved_date'];
    protected function alterInputs($input){
        foreach($input as $key=>$value){
            if(is_array($value)){
                $input[$key] = $this->alterInputs($value);
            }else{
                $input[$key] = $this->renderInput($key,$value);
            }
        }
        return $input;
    }
    private function renderInput($key,$value){
        if(in_array($key, $this->date_fields))
            return dateToDBFormat($value);
        if(in_array($key, $this->datetime_fields))
            return datetimeToDBFormat($value);
        return $value;
    }
}
