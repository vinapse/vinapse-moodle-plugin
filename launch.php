<?php

/**
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_daddyvideo\lti_helper;

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

/** @var moodle_database $DB */
/** @var core_user $USER */

$destinationpath = required_param('to', PARAM_URL);

// Require generic login on the LMS instance
require_login();

// Disallow guest access
if (isguestuser()) {
    echo get_string('nocapabilitytousethisservice', 'error');
    die();
}

// Take off
$content = lti_helper::daddy_request_lti_launch_generic($USER->id, $destinationpath);

echo $content;
