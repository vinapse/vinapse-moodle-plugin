<?php

/**
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_vinapse\lti_helper;

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

// Read the course module ID
$cmid = required_param('cmid', PARAM_INT);

// Read the chat query
$query = optional_param('query', '', PARAM_TEXT);

/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */

// Load the course and course module
list ($course, $cm) = get_course_and_cm_from_cmid($cmid, 'vinapsechat');

// Verify that the user can see this course module. The user might be a guest!
require_login($course, false, $cm);

// Stop guests
if (isguestuser()) {
    echo get_string('launch_guest_title', 'mod_vinapsechat');
    echo '<br>';
    echo get_string('launch_guest_description', 'mod_vinapsechat');
} else {
    $content = lti_helper::request_lti_launch_chat(
        $course->id,
        $course->shortname,
        $course->fullname,
        $query
    );
    echo $content;
}
