<?php

namespace ppt;


function test ($a, $b) { return
        $a === $b ;}


function test_group ($group_spec) {
    $all_true = true;
    $details = [];
    foreach ($group_spec as $spec) {
        $result = test ($spec[0], $spec[1]) ;
        $all_true = $all_true && $result ;
        $details[] = $result ;}
    return $all_true ? true : $details ;}


function test_all ($test_specs) {
    $all_true = true ;
    $details = [];
    foreach ($test_specs as $spec) {
        $group_name = array_shift ($spec) ;
        $result = test_group ($spec) ;
        $all_true = $all_true && is_bool ($result) ;
        $details[] = [$group_name, $result] ;}
    return $all_true ? true : $details ;}


function format_r ($a) { return
        (is_null ($a) ? 'NULL' :
         (is_bool ($a) ? ($a ? 'TRUE' : 'FALSE') :
          (is_string ($a) ? '"'. $a .'"' :
           (is_int ($a) || is_float ($a) ? (string) $a :
            print_r ($a, true))))) ;}


function format_test ($a, $b) { return
    ($a === $b ? ' ok' :
     "\n*** ERROR: ". format_r ($a) .' !== '. format_r ($b) ."\n") ;}


function format_test_group ($group_spec) {
    $ret = '';
    foreach ($group_spec as $spec) {
        $ret .= format_test ($spec[0], $spec[1]) ;}
    return $ret ;}


function format_test_all ($test_specs) {
    $ret = '';
    foreach ($test_specs as $spec) {
        $ret .= '- '. array_shift ($spec) .': '. format_test_group ($spec) ."\n" ;}
    return $ret ;}

