<?php

require 'Database.php';
$config = require 'Config.php';
$db = new Database($config);
require 'router.php';
