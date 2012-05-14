<?php
require("../src/bootstrap.php");
$o = plugin("com.foo.test");

$o->enablePlugin();
$config = $o->getPluginConfig();

$cls = new ReflectionClass($o);

var_dump($cls->getMethods());

var_dump($config);
