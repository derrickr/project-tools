<?php

# String helper functions
# ----------------------------------------------------------------------------
# str_sanitize()
# Makes a string safe for URLs

function str_sanitize($str, $space = '-') {
    $str = preg_replace('/&.+?;/', '', $str); # kill entities
    $str = preg_replace('/[^a-zA-Z0-9 _-]/', '', $str); # remove non alpha-numerics
    $str = preg_replace('/\s+/', ' ', $str); # condense white space
    $str = str_replace(' ', $space, $str); # replace spaces with $space
    $str = preg_replace('|-+|', $space, $str); #remove excessive $space characters
    $str = trim(strtolower($str), $space); # Lowercase and trim spaces
    return $str;
}

# ----------------------------------------------------------------------------

function str_default($str, $default = '-') {
    return trim($str) ? $str : $default;
}

# ----------------------------------------------------------------------------

function csv2table($csv, $include_headers = true) {
    $str = '<table>';
    $rows = explode("\n", $csv);
    if ($include_headers) {
        $str .= '<thead><tr>' . "\n";
        $headers = explode('","', array_shift($rows));
        foreach ($headers as $th) {
            $str .= '<th>' . trim($th, '"') . '</th>';
        }
        $str .= '</tr></thead>' . "\n";
    }
    $str .= '<tbody>';
    foreach ($rows as $row) {
        $cells = explode('","', $row);
        $str .= '<tr>';
        foreach ($cells as $td) {
            $str .= '<td>' . trim($td, '"') . '</td>';
        }
        $str .= '</tr>' . "\n";
    }
    $str .= '</tbody></table';
    return $str;
}

# ----------------------------------------------------------------------------
# Adapted from Smarty
# Optionally wrap in a span with the full test as a title
# If the $etc is an enitity it will be treated as one character long

function str_truncate($string, $length = 80, $etc = '&hellip;', $break_words = true, $span = false) {
    if ($length == 0)
        return '';
    $original = $string;
    if (strlen($string) > $length) {
        $length -= preg_match('/^&.+;/', $etc) ? 1 : strlen($etc);
        if (!$break_words)
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));
        if ($span)
            return "<span title=\"$original\">" . substr($string, 0, $length) . $etc . '</span>';
        else
            return substr($string, 0, $length) . $etc;
    } else
        return $string;
}

# ----------------------------------------------------------------------------
# str_concat_no_empty()
# Concatenates strings with delimiter whilst skipping empty strings

function str_concat_no_empty() {
    $args = func_get_args();
    if (!$args || count($args) < 2)
        return '';
    $dl = $args[0];
    $str = '';
    for ($i = 1; $i < count($args); $i++) {
        if (!trim($args[$i]))
            continue;
        $str .= $args[$i] . $dl;
    }
    return trim($str, $dl);
}

# ----------------------------------------------------------------------------
# Currency

function currency($n, $c = '&pound;', $empty = '-') {
    if ($n == '' || $n == 0)
        return $empty;
    // Convert codes to symbols if needs be
    switch ($c) {
        case 'GBP':
            $c = '&pound;';
            break;
        case 'EUR':
            $c = '&euro;';
            break;
        case 'USD':
        case 'USD_ex_EU':
            $c = '$';
            break;
    }
    $str = number_format(sprintf('%01.2f', $n), 2);
    if ($n >= 0) {
        $str = $c . $str;
    } else {
        # Move the neg before the
        $str = str_replace('-', '', $str);
        $str = '<span class="neg">-' . $c . $str . '</span>';
    }
    return $str;
}

# ----------------------------------------------------------------------------
# Pluralize

function pluralize($n, $str) {
    if ($n == 0) {
        $str = substr($str, -1, 1) == 'y' ? preg_replace('/y$/', 'ies', $str) : $str . 's';
        return 'No ' . $str;
    }
    if ($n == 1) {
        return 'One ' . $str;
    }
    if ($n > 1) {
        $str = substr($str, -1, 1) == 'y' ? preg_replace('/y$/', 'ies', $str) : $str . 's';
        return $n . ' ' . $str;
    }
}

# ----------------------------------------------------------------------------
# array_trim()

function array_trim($a, $chars = false) {
    foreach ($a as $k => $v) {
        if (is_array($v))
            $a[$k] = array_trim($v);
        if (is_string($v))
            $a[$k] = $chars ? trim($v, $chars) : trim($v);
    }
    return $a;
}

/* -------------------------------------------------------------------
  Recursively strip tags from array */

function strip_tags_all($arr) {
    foreach ($arr as $k => $v) {
        if (is_array($v)) {
            $arr[$k] = strip_tags_all($v);
        } else {
            $arr[$k] = strip_tags($v);
        }
    }
    return $arr;
}

/* -------------------------------------------------------------------
  implode_no_empty()
  Skips empty values in the array
 */

function implode_no_empty($d, $a) {
    $a = array_diff($a, array(
        ''
            ));
    return implode($d, $a);
    # Another way to do this:
    $a = preg_split("/$d/", implode($d, $a), -1, PREG_SPLIT_NO_EMPTY);
    return implode($d, $a);
}

/* -------------------------------------------------------------------
  i18nentities()
  All VARCHAR and TEXT fields need to be wrapped in this function. Or
  maybe the model should prepare them. Or the controller. I'm not sure
  about having to call it in the template, kind of a pain. But I want
  it to be obvious this is being used.

  Just call it on the entire output at the end. I use this as a callback
  on ob_start, which mucks up gzip handling, but that was causing probs
  anyway.

  I'm going to remove gzip handling as it can be done with Apache or
  a php.ini directive anyway.

 */

function i18nentities($str) {
    $from = 'HTML-ENTITIES';
    $to = 'auto';
    return mb_convert_encoding($str, $from, $to);
}

/* -------------------------------------------------------------------
  asciientities()
  Converts a string to ASCII HTML entities. Doesn't work with characters
  like � for some reason, regardless of the character encodings I use.
  Use i18nentities for those. This is just good for things like hiding
  email addresses

 */

function asciientities($str) {
    $str = trim($str);
    $outstr = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $char = substr($str, $i);
        if ($char != ' ') {
            $outstr .= "&#" . ord($char) . ";";
        } else {
            $oustr .= ' ';
        }
    }
    return $outstr;
}

/* -------------------------------------------------------------------
  column_display_label()

  Makes a nice readable version of a column label. This is also a good
  place to hook in translations if needs be. I need to figure that out later.

  Should this be done at scaffold time or at run time. Well, translations
  won't work unless it's at run time. No I've got that the wrong way round.
  I need to do this at scaffold time and wrap the label in _().

  This assumes you name your columns with underscores like:
  invoice_number, created_on etc. I don't support CamelCasing at the mo.
 */

function column_display_label($col_name) {
    return ucwords(str_replace('_', ' ', $col_name));
}

/* -------------------------------------------------------------------
  table_display_title()

  Similar to above, but for tables and allows pluralization.
  By convention I name tables with the plural.
 */

function table_display_title($tbl_name, $plural = true) {
    if ($plural) {
        return ucwords(str_replace('_', ' ', $tbl_name));
    } else {
        if (substr($tbl_name, -3) == 'ies') {
            $tbl_name = preg_replace('/ies$/', 'y', $tbl_name);
        } else {
            $tbl_name = preg_replace('/s$/', '', $tbl_name);
        }
        return ucwords(str_replace('_', ' ', $tbl_name));
    }
}

/* ------------------------------------------------------------------- */
/*
  Here's the functions for various page titles. Should these be called
  from the controller or from within the template itself?
  Probably from the controller, as this title wants to be available to the
  header.
 */

function list_view_title($tbl_name, $q = '', $qf = '') {
    $str = table_display_title($tbl_name);
    if ($q) {
        if ($qf) {
            $str .= ' &mdash; Search results for ' . column_display_label($qf) . ' matching <em>"' . $q . '"</em>';
        } else {
            $str .= ' &mdash; Search results for <em>"' . $q . '"</em>';
        }
    }
    return $str;
}

/* ------------------------------------------------------------------- */

function editor_view_title($tbl_name, $loaded = false) {
    if ($loaded) {
        return 'Editing ' . table_display_title($tbl_name, false) . ' ' . $loaded;
    } else {
        return 'Add New ' . table_display_title($tbl_name, false);
    }
}

/* ------------------------------------------------------------------- */

function entry_view_title($tbl_name, $loaded) {
    return table_display_title($tbl_name, false) . ' ' . $loaded;
}

/* ------------------------------------------------------------------- */

function search_results_msg($q = '', $qf = '') {
    $str = '';
    if ($q) {
        if ($qf) {
            $str .= 'Search results for ' . column_display_label($qf) . ' matching <em>"' . $q . '"</em>';
        } else {
            $str .= 'Search results for <em>"' . $q . '"</em>';
        }
    }
    return $str;
}

/* ------------------------------------------------------------------- */

function empty_list_msg($tbl_name, $q = '', $qf = '') {
    $str = 'There are no ' . strtolower(table_display_title($tbl_name));
    if ($q) {
        if ($qf) {
            $str .= ' with a ' . column_display_label($qf) . ' matching <em>"' . $q . '"</em>';
        } else {
            $str .= ' matching <em>"' . $q . '"</em>';
        }
    }
    return $str;
}

/* ------------------------------------------------------------------- */
/* function post_success_msg($tbl_name,$action){

  return 'The '. strtolower(table_display_title($tbl_name,false)) .
  ' has been successfully '. $action;
  } */
/* -------------------------------------------------------------------
  search_field_select($search_fields)

 */

function search_field_select($search_columns, $qf = '') {
    $str = '<select class="column_name" name="qf">' . '<option value="">All fields</option>' . "\n";
    foreach ($search_columns as $col) {
        $str .= '<option value="' . $col . '"';
        $str .= $qf == $col ? ' selected="selected">' : '>';
        $str .= _(column_display_label($col)) . "</option>\n";
    }
    return $str .= '</select>';
}

/* ------------------------------------------------------------------- */
/* array_combine for PHP 4 */
if (!function_exists('array_combine')) {

    function array_combine($keys, $vals) {
        $keys = array_values((array) $keys);
        $vals = array_values((array) $vals);
        $n = max(count($keys), count($vals));
        $r = array();
        for ($i = 0; $i < $n; $i++) {
            $r[$keys[$i]] = $vals[$i];
        }
        return $r;
    }

}
/* ------------------------------------------------------------------- */

function add_html_tag_attribute($html, $tag, $att, $value) {
    $html = str_replace("<$tag", "<$tag $att=\"$value\" ", $html);
    return $html;
}

/* ------------------------------------------------------------------- */

function url_set_variable($url, $qs, $name, $value) {
    if (!$qs) {
        return $url . '?' . $name . '=' . $value;
    } else if (preg_match("/.+$name=.+/", $qs)) {
        $tmp = explode('&', $qs);
        foreach ($tmp as $k => $token) {
            $tmp2 = explode('=', $token);
            if ($tmp2[0] == $name) {
                $tmp[$k] = $name . '=' . $value;
                break;
            }
        }
        $qs = implode('&amp;', $tmp);
    } else {
        $qs .= "&amp;$name=$value";
    }
    return $url . '?' . $qs;
}

// ----------------------------------------------------------------------------
/**
 * Sets a variable in the query string of the given URL
 * @param string $url The URL to add the variable to
 * @param string $name The name of the variable
 * @param string $value The value of the variable
 * @return string The new URL
 */
function set_url_var($url, $name, $value) {
    $purl = parse_url(unset_url_var($url, $name));
    if (isset($purl['query'])) {
        return $purl['path'] . '?' . $purl['query'] . "&amp;$name=$value";
    } else {
        return $purl['path'] . "?$name=$value";
    }
}

// ----------------------------------------------------------------------------
/*
 * Unsets a variable in the query string of the given URL
 * @param string $url The URL to add the variable to
 * @param string $name The name of the variable
 * @return string The new URL, any domain name will be lost
 */
function unset_url_var($url, $name) {
    $purl = parse_url($url);
    if (!isset($purl['query'])) {
        return $url;
    }
    $arr = array();
    parse_str($purl['query'], $arr);
    if (!isset($arr[$name])) {
        return $url;
    }
    unset($arr[$name]);
    if (count($arr)) {
        return $purl['path'] . '?' . http_build_query($arr);
    } else {
        return $purl['path'];
    }
}

function TrimStr($str) {
    $str = trim($str);
    $ret_str = '';
    for ($i = 0; $i < strlen($str); $i++) {
        if (substr($str, $i, 1) != " ") {
            $ret_str .= trim(substr($str, $i, 1));
        } else {
            while (substr($str, $i, 1) == " ") {
                $i++;
            }
            $ret_str .= " ";
            $i--;
        }
    }
    return $ret_str;
}

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function size_hum_read($size) {
    /*
      Returns a human readable size
     */
    $i = 0;
    $iec = array(
        "B",
        "KB",
        "MB",
        "GB",
        "TB",
        "PB",
        "EB",
        "ZB",
        "YB"
    );
    while (( $size / 1024 ) > 1) {
        $size = $size / 1024;
        $i++;
    }
    return substr($size, 0, strpos($size, '.') + 4) . $iec[$i];
}

if (!function_exists('custom_snake_case')) {

    function custom_snake_case($str, $delimiter = '_') {
        if (is_string($str)) {
            $str = str_replace('ID', 'Id', $str);
            return snake_case($str, $delimiter);
        }
        throwException('Argument 0 must be a sting.');
    }

}