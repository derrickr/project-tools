<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (! function_exists('array_underscore')) {
    /**
     * Flatten a multi-dimensional associative array with underscore.
     *
     * @param  array   $array
     * @param  string  $prepend
     * @return array
     */
    function array_underscore($array, $prepend = '')
    {
        return ProjectTools\Helpers\Helper::underscore($array, $prepend);
    }
}
if (! function_exists('array_keys_snake_case')) {
    /**
     * Flatten a multi-dimensional associative array with underscore.
     *
     * @param  array   $array
     * @param  string  $prepend
     * @return array
     */
    function array_keys_snake_case($array, $delimiter = '_')
    {
        $data=[];
        foreach ($array as $key=>$value){
            $new_key = custom_snake_case($key,$delimiter);
           $data[$new_key]= $value; 
        }
        return $data;
    }
}
