<?php

/*
 * Converts input array to search filter query based on column map
 */

use Carbon\Carbon;

function createSearchFilter($appliedFilters, $availableFilters = array()) {
    $filterQry = '';
// Create conditions and append to $filterQry
    if (!empty($appliedFilters)) {
        foreach ($appliedFilters as $afKey => $afValue) {
            if ($afKey && $afValue) {
// Add filters not given in column map
                if (!isset($availableFilters[$afKey])) {
                    if (is_numeric($afValue)) {
                        $type = 'number';
                    } else if (preg_match("#^[0-9]{1,2}/[0-9]{1,2}/[0-9]{4}$#", $afValue) == 1) {
                        $type = 'date';
                    } else {
                        $type = 'text';
                    }
                    $availableFilters[$afKey] = array(
                        'column' => $afKey,
                        'type' => $type
                    );
                }
                
                if (isset($availableFilters[$afKey]['columns'])) {
                    $columns = $availableFilters[$afKey]['columns'];
                    $filterQry.= "(";
                    foreach ($columns as $field) {
                        $filterQry.= $field . ' LIKE "%' . $afValue . '%" OR ';
                    }
                    $filterQry = rtrim($filterQry, " OR ");
                    $filterQry.= ") AND ";
                } else
                if ($afValue == 'NULL') {
                    $filterQry .= $availableFilters[$afKey]['column'] . " IS NULL AND ";
                } else if ($afValue == 'EMPTY') {
                    $filterQry .= $availableFilters[$afKey]['column'] . " = '' AND ";
                } else if ($afValue == 'NULL_OR_EMPTY') {
                    $filterQry .= "(" . $availableFilters[$afKey]['column'] . " IS NULL OR " . $availableFilters[$afKey]['column'] . " = '' ) AND ";
                } else if ($afValue == 'NOT_NULL') {
                    $filterQry .= $availableFilters[$afKey]['column'] . " IS NOT NULL AND ";
                } else if ($afValue == 'NOT_EMPTY') {
                    $filterQry .= $availableFilters[$afKey]['column'] . " != '' AND ";
                } else if ($afValue == 'NOT_NULL_OR_EMPTY') {
                    $filterQry .= $availableFilters[$afKey]['column'] . " IS NOT NULL AND " . $availableFilters[$afKey]['column'] . " !='' AND ";
                } else if ($afValue == 'never') {
                    $filterQry .= $availableFilters[$afKey]['column'] . " IS NULL AND ";
                } else if ($availableFilters[$afKey]['type'] == 'number') {
                    if (strpos($afValue, '-')) {
                        list( $min, $max ) = explode('-', $afValue);
                        $min = trim($min);
                        $max = trim($max);
                        if (is_numeric($min) && is_numeric($max) && $max > $min) {
                            $filterQry .= $availableFilters[$afKey]['column'] . " BETWEEN " . $min . " AND " . $max . " AND ";
                        }
                    } else if (strpos($afValue, '>') === 0) {
                        $tmpValue = str_replace('>', '', $afValue);
                        if (is_numeric($tmpValue)) {
                            $filterQry .= $availableFilters[$afKey]['column'] . " > " . $tmpValue . " AND ";
                        }
                    } else if (strpos($afValue, '<') === 0) {
                        $tmpValue = str_replace('<', '', $afValue);
                        if (is_numeric($tmpValue)) {
                            $filterQry .= $availableFilters[$afKey]['column'] . " < " . $tmpValue . " AND ";
                        }
                    } else if (strstr($afValue, ',')) {
                        $filterQry .= $availableFilters[$afKey]['column'] . "IN (" . $afValue . ") AND ";
                    } else if (is_numeric($afValue)) {
                        $filterQry .= $availableFilters[$afKey]['column'] . " = " . $afValue . " AND ";
                    }
                } else if ($availableFilters[$afKey]['type'] == 'text') {
                    if (strpos($afValue, '!') === 0) {
                        $not = ' NOT';
                        $afValue = substr($afValue, 1);
                    } else {
                        $not = '';
                    }
                    if (strstr($afValue, '*')) {
                        $tmpValue = str_replace('*', '%', $afValue);
                        $filterQry .= $availableFilters[$afKey]['column'] . $not . " LIKE '" . $tmpValue . "' AND ";
                    } else if (strstr($afValue, ',')) {
                        $tmp = explode(',', $afValue);
                        $str = '';
                        foreach ($tmp as $v) {
                            $str .= "'" . $v . "',";
                        }
                        $str = rtrim($str, ",");
                        $filterQry .= $availableFilters[$afKey]['column'] . $not . " IN (" . $str . ") AND ";
                    } else {
                        $filterQry .= $availableFilters[$afKey]['column'] . $not . " LIKE '%" . $afValue . "%' AND ";
                    }
                } else if ($availableFilters[$afKey]['type'] == 'date') {
                    if (strpos($afValue, 'before') === 0) {
                        $tmpValue = str_replace('before ', '', $afValue);
                        $filterQry .= $availableFilters[$afKey]['column'] . " < '" . dateToDBFormat($tmpValue)->format('Y-m-d') . "' AND ";
                    } else if (strpos($afValue, 'after') === 0) {
                        $tmpValue = str_replace('after ', '', $afValue);
                        $filterQry .= $availableFilters[$afKey]['column'] . " > '" . dateToDBFormat($tmpValue)->format('Y-m-d') . "' AND ";
                    } else if (strpos($afKey, 'before-') === 0) {
                        $filterQry .= $availableFilters[$afKey]['column'] . " < '" . dateToDBFormat($afValue)->format('Y-m-d') . "' AND ";
                    } else if (strpos($afKey, 'after') === 0) {
                        $filterQry .= $availableFilters[$afKey]['column'] . " > '" . dateToDBFormat($afValue)->format('Y-m-d') . "' AND ";
                    } else if (strpos($afValue, '-')) {
                        list( $start, $end ) = explode('-', $afValue);
                        $start = trim($start);
                        $end = trim($end);
                        $start = dateToDBFormat($start)->startOfDay();
                        $end = dateToDBFormat($end)->endOfDay();
                        $filterQry .= "(" . $availableFilters[$afKey]['column'] . " BETWEEN '" . $start . "' AND '" . $end . "') AND ";
                    } else {
                        $tmpValue = dateToDBFormat($afValue)->format('Y-m-d');
                        $filterQry .= $availableFilters[$afKey]['column'] . " LIKE '" . $tmpValue . "%' AND ";
                    }
                } 
                else if ($availableFilters[$afKey]['type'] == 'daterange') {
                    if (strpos($afValue, '-')) {
                        list( $start, $end ) = explode('-', $afValue);
                        $start = trim($start);
                        $end = trim($end);
                        $start = dateToDBFormat($start)->format('Y-m-d');
                        $end = dateToDBFormat($end)->format('Y-m-d');
//                        if (strpos($end, '00:00:00'))
//                            $end = str_replace('00:00:00', '23:59:59', $end);
                        $filterQry .= "(" . $availableFilters[$afKey]['column'] . " BETWEEN '" . $start . "' AND '" . $end . "') AND ";
                    } else {
                        $tmpValue = dateToDBFormat($afValue);
                        $filterQry .= $availableFilters[$afKey]['column'] . " LIKE '" . $tmpValue . "%' AND ";
                    }
                } 
                else if ($availableFilters[$afKey]['type'] == 'select') {
                    if (strpos($afValue, ',')) {
                        $fileds = str_replace(',', "','", $afValue);
                        $filterQry .= $availableFilters[$afKey]['column'] . " IN ('" . $fileds . "') AND ";
                    } else {
                        $filterQry .= $availableFilters[$afKey]['column'] . " = '" . $afValue . "' AND ";
                    }
                } else {
                    $filterQry .= $availableFilters[$afKey]['column'] . " LIKE '%" . $afValue . "%' AND ";
                }
            } elseif ($afKey && $afValue == 0) {
                if (isset($availableFilters[$afKey])) {
                    if(!isset($availableFilters[$afKey]['columns'])){
                        $filterQry .= $availableFilters[$afKey]['column'] . " = 0 AND ";
                    }
                }
            }
        }
    }
// Remove trailing AND
    if ($filterQry) {
        $filterQry = rtrim($filterQry, " AND ");
    }
    return $filterQry;
}

function dateToDBFormat($date) {
    if ($date instanceof Carbon) {
        return $date;
    }
    $js_date_format = default_date_format();
    
    $date_conversion = date_conversion();
    if (!array_key_exists($js_date_format, $date_conversion))
        return null;
    $formattedDate = null;
    if ($date) {
        $date = trim($date);
        $formattedDate = Carbon::createFromFormat($date_conversion[$js_date_format], $date);
    }
    return $formattedDate;
}
function datetimeToDBFormat($date) {
    if ($date instanceof Carbon) {
        return $date;
    }
    $js_date_format = default_date_format(true);
    $date_conversion = date_conversion();
    if (!array_key_exists($js_date_format, $date_conversion))
        return null;
    $formattedDate = null;
    $format = $date_conversion[$js_date_format];
    if ($date) {
        if (strlen(trim($date)) == 10) {
            $format_arr = explode(' ', $format, 2);
            $format = $format_arr[0];
        }
        $date = trim($date);
        $formattedDate = Carbon::createFromFormat($format, $date);
    }
    return $formattedDate;
}

function addSearchAttributes($input) {
// Initialize
    $orderBy = '';
    $order = '';
    $columns = ['*'];
    $searchFilters = '';
    $paginate = $exportPaginate = $modalpaginate = $query_object=$with_trash=0;
    $page_limit = PAGE_LIMIT;
    $where = [];
    $raw_where = null;
// Order and order by
    if (isset($input['o']) and $input['o'] != '') {
        $orderBy = $input['o'];
    }
    if (isset($input['d']) and $input['d'] != '') {
        $order = $input['d'];
    }
// Columns
    if (isset($input['columns']) and $input['columns'] != '') {
        $columns = $input['columns'];
    }
// Paginate
    if (isset($input['paginate']) and $input['paginate']) {
        $paginate = 1;
    }
    if (isset($input['page_limit']) and $input['page_limit']) {
        $page_limit = $input['page_limit'];
    }
    if (isset($input['exportPaginate']) and $input['exportPaginate']) {
        $exportPaginate = 1;
    }
    if (isset($input['modalpaginate']) and $input['modalpaginate']) {
        $modalpaginate = 1;
    }
    if (isset($input['query_object']) and $input['query_object']) {
        $query_object = 1;
    }
    //Add Trash
    if (isset($input['with_trash']) and $input['with_trash']) {
        $with_trash = 1;
    }
// Add where
    if (isset($input['where']) and $input['where']) {
        $where = $input['where'];
    }
    if (isset($input['raw_where']) and $input['raw_where']) {
        $raw_where = $input['raw_where'];
    }
// Add search filters
    if (isset($input['f'])) {
        if (isset($input['search_filters'])) {
            $searchFilters = createSearchFilter($input['f'], $input['search_filters']);
        } else {
            $searchFilters = createSearchFilter($input['f']);
        }
    }
    return [
        'orderBy' => $orderBy,
        'order' => $order,
        'columns' => $columns,
        'paginate' => $paginate,
        'page_limit' => $page_limit,
        'exportPaginate' => $exportPaginate,
        'modalpaginate' => $modalpaginate,
        'where' => $where,
        'searchFilters' => $searchFilters,
        'query_object'=> $query_object,
        'with_trash'=>$with_trash,
        'raw_where'=>$raw_where
    ];
}

function column_sort_link($col_name, $col_type, $label = '', $xtra_class = '') {
    $query_string = '';
    if (isset($_SERVER['QUERY_STRING']))
        $query_string = $_SERVER['QUERY_STRING'];
    if (!$label)
        $label = $col_name;
    $qs = preg_replace('/&?o=[A-Za-z_0-9\.]*&?/', '', $query_string);
    $qs = preg_replace('/&?d=[a-z]*&?/', '', $qs);
    $qs = preg_replace('/&?p=[0-9]*&?/', '', $qs);
    $qs = preg_replace('/&?ps=[0-9]*&?/', '', $qs);
    $qs = preg_replace('/&([a-z])/', "&amp;$1", $qs);

    $c_order_dir = isset($_GET['d']) ? strtoupper($_GET['d']) : '';
    $order_by = isset($_GET['o']) ? $_GET['o'] : '';
    $order_dir = 'asc';
    $ps = isset($_GET['ps']) ? $_GET['ps'] : '';
    $class  = $title = '';
    $icon_class = ' fa-sort';
    if ($order_by == $col_name) {
        if (!$c_order_dir || $c_order_dir == 'ASC') {
            $order_dir = 'desc';
            $class = 'up';
            $icon_class = 'fa-sort-asc';
            
            switch ($col_type) {
                case 'text':
                    $title = 'Sorted A to Z';
                    break;
                case 'date':
                    $title = 'Sorted oldest to newest';
                    break;
                case 'number':
                    $title = 'Sorted lowest to highest';
            }
        } else {
            $class = 'down';
            $icon_class = 'fa-sort-desc';
            switch ($col_type) {
                case 'text':
                    $title = 'Sorted Z to A';
                    break;
                case 'date':
                    $title = 'Sorted newest to oldest';
                    break;
                case 'number':
                    $title = 'Sorted highest to lowest';
            }
        }
    } else {
        $title = "Sort by this column";
    }

    $url = '?o=' . $col_name . '&amp;d=' . $order_dir;
    if ($ps) {
        $url .= '&amp;ps=' . $ps;
    }
    if ($qs) {
        $url .= '&amp;' . $qs;
    }
    if ($xtra_class)
        $class .= ' ' . $xtra_class;
    $str = $class ? '<a href="' . $url . '" class="' . $class . '" title="' . $title . '">' : '<a href="' . $url . '" title="' . $title . '">';
    $str .= $label . '</a><i class="fa fa-fw ' . $icon_class . ' pull-right"></i>';

    return $str;
}

?>