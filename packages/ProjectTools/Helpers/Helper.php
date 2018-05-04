<?php

namespace ProjectTools\Helpers;
use DB;
use Illuminate\Routing\Controller as BaseController;
use Mail;


class Helper
{

    /*meera functions starts dec 2016*/

    public static function getCommonJsVar(){
        return [
            'jdebug'=>true,
            'date_format' =>  default_date_format(),
            'base_url'=> url('/'),
            'ga_api_key' => env('GA_API_KEY',''),
            'datetime_format'=> default_date_format($time=true),
            'phone_mask'=> config('projecttool.phone_mask')
        ];
    }
    
    public static function getContactType($type_id){
        if($type_id){
            $contact_types = getContactTypes();
            if(array_key_exists($type_id, $contact_types)){
                return $contact_types[$type_id];
            }
        }
        return '';
    }
    public static function underscore($array, $prepend = '')
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (is_array($value) && ! empty($value)) {
                $results = array_merge($results, static::underscore($value, $prepend.$key.'_'));
            } else {
                $results[$prepend.$key] = $value;
            }
        }
        return $results;
    }
    
}

