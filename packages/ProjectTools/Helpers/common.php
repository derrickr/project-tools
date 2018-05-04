<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools ',' Templates
 * and open the template in the editor.
 */
use Illuminate\Support\Facades\DB;
const PAGE_LIMIT = 25;
function getPageLimits(){
    return ['10'=>'10','20' => '20', '25' => '25', '50' => '50'];
}
function getDropDown() {
    return [
        'roles' => ['Admin' => 'admin', 'Assessor' => 'assessor', 'Analyser' => 'analyser', 'Coster' => 'coster', 'Scheduler' => 'scheduler', 'Approver' => 'approver', 'Implementer' => 'implementer', 'Tester' => 'tester','Project Manager'=>'projectmanager'],
       ];
}

function getDbDropDown($model, $value, $key, $options = []) {
    $model = '\\App\\' . ucfirst($model);
    $obj = new $model();
    $obj = $obj->select([$value, $key]);
    if (isset($options['select'])) {
       $obj = $obj->select(DB::raw($options['select']));
    }
    if (isset($options['where'])) {
        foreach ($options['where'] as $akey => $svalue) {
            $obj = $obj->where($akey, '=', $svalue);
        }
        
    }
    if (isset($options['order'])) {
        if(isset($options['order'][0])){
            $obj = $obj->orderBy($options['order'][0],  isset($options['order'][1])?$options['order'][1]:'ASC');
        }
    }
//    dd($obj->toSql());
    $obj = $obj->get();
    $array = array_pluck($obj, $value, $key);
    return $array;
}


function getOptionKeyValue($type, $db = false, $value = null, $key = null, $options = []) {

    if ($db) {
        return getDbDropDown($type, $value, $key, $options);
    } else {
        $option_array = getDropDown();
        if (in_array($type, array_keys($option_array))) {
           return $option_array[$type];
        }
    }
    return [];
}

function getOptionValue($type, $key) {
    $option_array = getOptionKeyValue($type);
    if (array_key_exists($key, $option_array)) {
        return $option_array[$key];
    }
    return null;
}
function getOptionValueFull($type, $key) {
    $setting = new Setting();
    $option_array = $setting->getOptionsArray($type,true);
    if (array_key_exists($key, $option_array)) {
        return $option_array[$key];
    }
    return [];
}

if (! function_exists('ddk')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function ddk($data ,$exit=true)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if($exit)
            exit;
    }
}
function my_encrypt($string){
    if(env('crypt',false))
        return encrypt($string);
    return $string;
}
function my_decrypt($string){
    if(env('crypt',false))
        return decrypt($string);
    return $string;
}

function mylabel($type,$value){
    if($type == 'request'){
        if($value == \App\Requests::STATUS_ACCEPT){
            return '<span class="label accepted">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_ANALYSED){
            return '<span class="label analysed">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_APPROVED){
            return '<span class="label approved">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_CANCEL){
            return '<span class="label cancelled">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_COMPLETED){
            return '<span class="label completed">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_COSTED){
            return '<span class="label costed">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_FAILTESTING){
            return '<span class="label failtesting">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_FAST_TRACK){
            return '<span class="label fasttrack">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_MOREINFO){
            return '<span class="label moreinfo">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_MORETIME){
            return '<span class="label moretime">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_NEW){
            return '<span class="label new">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_REJECT){
            return '<span class="label rejected">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_REOPEN){
            return '<span class="label reopened">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_SCHEDULE){
            return '<span class="label scheduled">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_IMPLEMENTED){
            return '<span class="label implemented">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_REWORKING){
            return '<span class="label reworked">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_BACKINGOUT){
            return '<span class="label backout">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_BACKEDOUT){
            return '<span class="label backedout">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_PASS){
            return '<span class="label pass">'.$value.'</span>';
        }
        elseif($value == \App\Requests::STATUS_FAILEDTESTING){
            return '<span class="label failtesting">'.$value.'</span>';
        }
        else{
            return '<span class="label">'.$value.'</span>';
        }
        
    }
}

function getSkillsValues($skills = array()){
    $ff = array();
    if($skills){
        $assigned_skills = explode(',', $skills);
        $arr_skills = array();
        foreach ($assigned_skills as $skill){
            $arr_skills = explode('=', $skill);
            $ff[$arr_skills[0]] = $arr_skills[1];
        }
    }
    return $ff;
}
function info_html($info,$placement='right' ){
    return '<a href="#" data-toggle="tooltip" data-placement="'.$placement.'" title="'.$info.'" ><i class="fa fa-fw fa-info-circle"></i></a>';
}

?>