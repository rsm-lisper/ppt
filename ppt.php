<?php

namespace rsm_lisper\ppt;


/**
 * Almost like print_r but better, and it returns instead of printing.
 *
 * @param mixed $a Argument to format as a string.
 * @return string
 */
function format_r ($a) { return
        (is_null ($a) ? 'NULL' :
         (is_bool ($a) ? ($a ? 'TRUE' : 'FALSE') :
          (is_string ($a) ? '"'. $a .'"' :
           (is_int ($a) || is_float ($a) ? (string) $a :
            print_r ($a, true))))) ;}


/**
 * $a === $b comparison as a function.
 *
 * @param string $name Name of the test.
 * @param mixed $a Argument to compare against $b.
 * @param mixed $b Argument to compare against $a.
 * @return bool|string Returns true on success or string describing problem.
 */
function do_test ($name, $a, $b) { return
    ($a === $b ? true :
     "
---[TEST: ". $name ."]---
*** NOT EQUAL [A]: ". format_r ($a) ."
*** NOT EQUAL [B]: ". format_r ($b) ."
") ;}


/**
 * @param string $group_name
 * @param array $group_tests
 * @return bool|string
 */
function test_group ($group_name, $group_tests) {
    $all_true = true ;
    $details = '' ;
    foreach ($group_tests as $spec) {
        $result = do_test ($spec[0], $spec[1], $spec[2]) ;
        if (is_string ($result)) {
            $all_true = false;
            $details .= $result ;}}
    return $all_true ? true :
        "\n-[GROUP: ". $group_name ."]-". $details ;}


/**
 * @param array $test_specs
 * @return bool|string
 */
function test_all ($test_specs) {
    $all_true = true ;
    $details = '' ;
    foreach ($test_specs as $spec) {
        $result = test_group (array_shift ($spec), $spec) ;
        if (is_string ($result)) {
            $all_true = false ;
            $details .= $result ;}}
    return $all_true ? true : $details ;}


/**
 * @param bool|string $test_result
 * @return void
 */
function exit_nicely ($test_result) {
    if (is_string ($test_result)) {
        print ($test_result) ;
        exit (-1) ;}
    exit (0) ;}
