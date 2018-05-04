<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function default_date_format($time = false) {
    if ($time)
        return config('projecttool.datetime_format');
    else
        return config('projecttool.date_format');
}

function default_php_date_format($time = false) {
    $date_formats = date_conversion();
    return $date_formats[default_date_format($time)];
}

function date_conversion() {
    return [
        'dd/mm/yyyy' => 'd/m/Y',
        'mm/dd/yyyy' => 'm/d/Y',
        'DD/MM/YYYY hh:mm A'=>'d/m/Y h:i A',
        'yyyy-mm-dd' => 'Y-m-d',
        'YYYY-MM-DD hh:mm A'=>'Y-m-d h:i A'
    ];
}
function mydate_format( $d = false, $alt = '' )
    {
    $format = default_php_date_format();
      # Check the date only contains letters, numbers and
      # accepted delimiters. If not, just return the string.
      if ( preg_match( '/[^\w0-9:\/ -]/', $d ) )
        return $d;
      if ( $d ) {
        if ( !is_numeric( $d ) ) {
          $ts = strtotime_uk( $d );
        } else {
          $ts = $d;
        }        
        if ( $ts === -1 )
          return $d; # If invalid just return input
        return date( $format, $ts );
      }
      return $alt;
    }
function mydatetime_format( $d = false, $alt = '' )
 {
    $format = default_php_date_format($time = true);
    $formattedDate = $alt;
    if ($d) {
        $d = trim($d);
        $formattedDate = Carbon\Carbon::parse($d)->format($format);
    }
    return $formattedDate;
}
function mytime_format( $d = false, $alt = '' )
 {
    $format = default_php_date_format($time = true);
    $formattedDate = $alt;
    if ($d) {
        $d = trim($d);
        $formattedDate = Carbon\Carbon::parse($d)->format('h:i A');
    }
    return $formattedDate;
}

function strtotime_uk( $str )
    {
      $str = preg_replace( '/^\s*([\d]{1,2})[\/\. -]+([\d]{1,2})[\/\. -]*([\d]{0,4})/', '\\2/\\1/\\3', $str );
      $str = trim( $str, '/.-' );
      return strtotime( $str );
    }