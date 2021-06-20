<?php

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once(dirname(dirname(dirname(__FILE__))) . '/locallib.php');

$uuid = optional_param('uuid', NULL, PARAM_STRINGID);
$department = optional_param('department', NULL, PARAM_STRINGID);
$year = optional_param('year', NULL, PARAM_STRINGID);
$content = local_daddy_request_lti_launch($uuid, $department, $year);
echo $content;
