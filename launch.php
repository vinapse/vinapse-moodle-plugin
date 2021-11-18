<?php

/**
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_daddyvideo\lti_helper;

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */
/** @var core_user $USER */

$destinationpath = required_param('to', PARAM_URL);

// Require login but don't auto-login guests
require_login(null, false);

// However if the user is already logged in as a guest, show a page to force him to login (again)
if (isguestuser()) {
    $PAGE->set_pagelayout('standard');
    $PAGE->set_url('/mod/daddyvideo/launch.php', array('to' => $destinationpath));
    $PAGE->set_title(get_string('modulename', 'mod_daddyvideo'));
    $PAGE->set_heading(get_string('modulename', 'mod_daddyvideo'));

    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('launch_title', 'mod_daddyvideo'));

    notice(get_string('launch_description', 'mod_daddyvideo'), get_login_url());
} else {
    $content = lti_helper::daddy_request_lti_launch_generic($USER->id, $destinationpath);
    echo $content;
}
