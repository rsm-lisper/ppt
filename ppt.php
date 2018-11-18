<?php

namespace ppt;


function test ($a, $b) { return
        $a === $b ;}


function test_group ($group_name, $group_tests) {
    $all_true = true;
    $details = [$group_name];
    foreach ($group_tests as $spec) {
        $result = test ($spec[0], $spec[1]) ;
        $all_true = $all_true && $result ;
        $details[] = $result ;}
    return $all_true ? true : $details ;}


function test_all ($test_specs) {
    $all_true = true ;
    $details = [];
    foreach ($test_specs as $spec) {
        $result = test_group (array_shift ($spec), $spec) ;
        if (is_array ($result)) {
            $all_true = false ;
            $details[] = $result ;}}
    return $all_true ? true : $details ;}


function format_r ($a) { return
        (is_null ($a) ? 'NULL' :
         (is_bool ($a) ? ($a ? 'TRUE' : 'FALSE') :
          (is_string ($a) ? '"'. $a .'"' :
           (is_int ($a) || is_float ($a) ? (string) $a :
            print_r ($a, true))))) ;}


function format_test ($a, $b) { return
    ($a === $b ? true :
     "
---[ERROR]---
*** NOT EQUAL [A]: ". format_r ($a) ."
*** NOT EQUAL [B]: ". format_r ($b) ."
------
") ;}


function format_test_group ($group_name, $group_tests) {
    $all_true = true ;
    $details = '-[GROUP: '. $group_name ."]-\n";
    foreach ($group_tests as $spec) {
        $result = format_test ($spec[0], $spec[1]) ;
        if (is_string ($result)) {
            $all_true = false;
            $details .= $result ;}}
    return $all_true ? true : $details ;}


function format_test_all ($test_specs) {
    $all_true = true ;
    $details = '' ;
    foreach ($test_specs as $spec) {
        $result = format_test_group (array_shift ($spec), $spec) ;
        if (is_string ($result)) {
            $all_true = false ;
            $details .= $result ;}}
    return $all_true ? true : $details ;}

