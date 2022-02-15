<?php

$re = '/[A-Z]/';
$re = '/[a-z]/';
$re = '/[$&+,:;=?@#|\'<>.^*()%!-]/';
$str = "123456z7890zA";
if (preg_match($re, $str) != 1) {
    echo "shit";
} else {
    echo "nice";
}
