<?php

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(dirname(dirname(__FILE__))).'/local/daddyvideo/locallib.php');

$uuid = required_param('uuid', PARAM_STRINGID);


$content = local_daddy_request_lti_launch($uuid);
echo $content;
