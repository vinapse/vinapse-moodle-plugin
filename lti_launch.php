<?php

use mod_daddyvideo\lti_helper;

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

$uuid = optional_param('uuid', NULL, PARAM_STRINGID);
$department = optional_param('department', NULL, PARAM_STRINGID);
$year = optional_param('year', NULL, PARAM_STRINGID);
$content = lti_helper::daddy_request_lti_launch($uuid, $department, $year);
echo $content;
