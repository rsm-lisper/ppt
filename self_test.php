<?php

require 'ppt.php' ;

use function ppt\format_r, ppt\do_test, ppt\test_group,
    ppt\test_all, ppt\exit_nicely ;


$self_test_specs = [
    ['format_r',
     ['false', format_r (false), 'false'],
     ['true', format_r (true), 'TRUE'],
     ['null', format_r (null), 'Null'],
     ['string', format_r ('some text'), '"some text"'],
     ['int', format_r (1), '1']],
    ['do_test',
     ['1 = 1', do_test ('t', 1, 1), ''],
     ['1 = 10.1', do_test ('t', 1, 10.1),
      "
--[ TEST: t ]--
---- received: ----
1
---- expected: ----
10.1
-------------------
"],
     ['1 = 1.1', do_test ('t', 1, 1.1),
      "
--[ TEST: t ]--
---- received: ----
1
---- expected: ----
1.1
-------------------
"],
     ['1 = "1"', do_test ('t', 1, "1"),
      "
--[ TEST: t ]--
---- received: ----
1
---- expected: ----
\"1\"
-------------------
"],
     ['alfa = al.fa', do_test ('t', "alfa", "al"."fa"), ''],
     ['2 = 1+1', do_test ('t', 2, 1+1), ''],
     ['2.5*4.0 = 10.0', do_test ('t', 2.5 * 4.0, 10.0), '']],
    ['test_group',
     ['is_int true',
      test_group ('is_int', [['t', is_int (1), true]]),
      ''],
     ['is_int false',
      test_group ('is_int', [['no', is_int ('no'), true]]),
      "
-[[ GROUP: is_int ]]-
--[ TEST: no ]--
---- received: ----
false
---- expected: ----
TRUE
-------------------
"]
    ]];


exit_nicely (test_all ($self_test_specs)) ;
