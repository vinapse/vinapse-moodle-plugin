<?php

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(dirname(dirname(__FILE__))).'/local/daddyvideo/locallib.php');

$uuid = optional_param('uuid', NULL, PARAM_STRINGID);
$department = optional_param('department', NULL, PARAM_STRIND);
$year = optional_param('year', NULL, PARAM_STRING);
$content = local_daddy_request_lti_launch($uuid);
echo $content;
