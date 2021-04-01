<?php

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(dirname(dirname(__FILE__))).'/local/daddyvideo/locallib.php');

$content = local_daddy_request_lti_launch();
echo $content;
