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

$courseid = required_param('courseId', PARAM_INT);
$lectureuuid = required_param('lectureUUID', PARAM_ALPHANUMEXT);

// Get the module instance from its own table
$instance = $DB->get_record(
    'daddyvideo',
    array('course' => $courseid, 'remoteuuid' => $lectureuuid),
    '*',
    MUST_EXIST
);

// Get course and course module
list ($course, $cm) = get_course_and_cm_from_instance($instance->id, 'daddyvideo', $courseid);

// Verify that the user can see this course module
require_login($course, true, $cm);

// Disallow guest access
if (is_guest(context_course::instance($course->id))) {
    echo get_string('nocapabilitytousethisservice', 'error');
    die();
}

$roles = lti_helper::daddy_get_ims_roles($course->id);

// Take off
$content = lti_helper::daddy_request_lti_launch_lecture(
    $instance->remoteuuid,
    $roles,
    $USER->id,
    $course->id,
    $course->shortname,
    $course->fullname,
    $instance->name,
    $instance->intro
);

echo $content;
