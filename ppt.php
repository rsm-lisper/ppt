<?php

namespace ppt ;


/**
 * Almost like print_r but better, and it returns instead of printing!
 *
 * @param mixed $a Argument to format as a string.
 * @return string
 */
function format_r ($a) { return
        ($a === null ? 'Null' :
         (is_bool ($a) ? ($a ? 'TRUE' : 'false') :
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
    ($a === $b ? '' :
     "
---[TEST: ". $name ."]---
*** NOT EQUAL [A]: ". format_r ($a) ."
*** NOT EQUAL [B]: ". format_r ($b) ."
") ;}


/**
 * @param string $group_name
 * @param array $group_tests
 * @return string
 */
function test_group ($group_name, $group_tests) {
    $details = '' ;
    foreach ($group_tests as $spec) {
        $details .= do_test ($spec[0], $spec[1], $spec[2]) ;}
    return $details === '' ? '' :
        "\n-[GROUP: ". $group_name ."]-". $details ;}


/**
 * @param array $test_specs
 * @return string
 */
function test_all ($test_specs) {
    $details = '' ;
    foreach ($test_specs as $spec) {
        $details .= test_group (array_shift ($spec), $spec) ;}
    return $details === '' ? '' : $details ;}


/**
 * @param bool|string $test_result
 * @return void
 */
function exit_nicely ($test_result) {
    if ($test_result !== '') {
        print ($test_result) ;
        exit (-1) ;}
    exit (0) ;}
