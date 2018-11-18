<?php

require 'ppt.php' ;

use function ppt\test, ppt\test_group, ppt\test_all, ppt\format_r, ppt\format_test, ppt\format_test_group, ppt\format_test_all ;


$self_test_specs = [
    ['test',
     [test (1, 1), true],
     [test (1, 10.1), false],
     [test (1, 1.0), false],
     [test (1, "1"), false],
     [test ("alfa", "al"."fa"), true],
     [test (2, 1+1), true],
     [test (2.5 * 4.0, 10.0), true]],
    ['test_group',
     [test_group ('ttest', [[test (1, 1), true]]),
      true],
     [test_group ('ttest', [[test (1, 1), true], [test (10.1, 10.1), true]]),
      true],
     [test_group ('ftest', [[test (1, 0), true]]),
      ['ftest', false]],
     [test_group ('ftest', [[test (5/2, 2.5), true], [test (1, true), true]]),
      ['ftest', true, false]],
     [test_group ('ftest', [[test (5/2, 2), true], [test (1, true), true]]),
      ['ftest', false, false]]],
    ['format_r',
     [format_r (false), 'FALSE'],
     [format_r (true), 'TRUE'],
     [format_r (null), 'NULL'],
     [format_r ('some text'), '"some text"'],
     [format_r (1), '1']],
    ['format_test',
     [format_test (1, 1), true],
     [format_test (1, 10.1), "\n---[ERROR]---\n*** NOT EQUAL [A]: 1\n*** NOT EQUAL [B]: 10.1\n------\n"],
     [format_test (1, 1.1), "\n---[ERROR]---\n*** NOT EQUAL [A]: 1\n*** NOT EQUAL [B]: 1.1\n------\n"],
     [format_test (1, "1"), "\n---[ERROR]---\n*** NOT EQUAL [A]: 1\n*** NOT EQUAL [B]: \"1\"\n------\n"],
     [format_test ("alfa", "al"."fa"), true],
     [format_test (2, 1+1), true],
     [format_test (2.5 * 4.0, 10.0), true]] ];


$result = format_test_all ($self_test_specs) ;
if (is_string ($result)) {
    print ($result) ;
    exit (-1) ;}
exit (0) ;
