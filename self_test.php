<?php

namespace ppt;

require 'ppt.php';


$self_test_specs = [
    ['test',
     [test (1, 1), true],
     [test (1, 10.1), false],
     [test (1, 1.0), false],
     [test (1, "1"), false],
     [test ("alfa", "al"."fa"), true],
     [test (2, 1+1), true],
     [test (2.5 * 4.0, 10.0), true]],
    ['format_r',
     [format_r (false), 'FALSE'],
     [format_r (true), 'TRUE'],
     [format_r (null), 'NULL'],
     [format_r ('some text'), '"some text"'],
     [format_r (1), '1']],
    ['format_test',
     [format_test (1, 1), ' ok'],
     [format_test (1, 10.1), "\n*** ERROR: 1 !== 10.1\n"],
     [format_test (1, 1.1), "\n*** ERROR: 1 !== 1.1\n"],
     [format_test (1, "1"), "\n*** ERROR: 1 !== \"1\"\n"],
     [format_test ("alfa", "al"."fa"), ' ok'],
     [format_test (2, 1+1), ' ok'],
     [format_test (2.5 * 4.0, 10.0), ' ok']] ];


print (format_test_all ($self_test_specs));
