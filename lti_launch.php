<?php

use mod_daddyvideo\lti_helper;

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

$uuid = required_param('uuid', PARAM_ALPHANUMEXT);
$content = lti_helper::daddy_request_lti_launch($uuid);

echo $content;
