<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

function fn_assert_handler($file, $line, $code)
{
	throw new Exception();
}

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);
assert_options(ASSERT_CALLBACK, "fn_assert_handler");

function jassert($obj)
{
	assert(!empty($obj));
}

?>