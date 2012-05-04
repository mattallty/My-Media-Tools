#!/usr/bin/env php
<?php
require("../bootstrap.php");
array_shift($_SERVER['argv']);
$router = new Mmt_Cli_Router();
$router->handleCommands($_SERVER['argv']);
