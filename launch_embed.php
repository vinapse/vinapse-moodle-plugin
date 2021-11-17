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
$context = context_course::instance($course->id);
if (is_guest($context)) {
    echo get_string('nocapabilitytousethisservice', 'error');
    die();
}

// Check whether the current user has the capability to edit module instances
$canedit = has_capability('mod/daddyvideo:addinstance', $context);
$role = $canedit ? 'Instructor' : 'Learner';

# TODO: use lti_get_ims_role() for roles

// Take off
$content = lti_helper::daddy_request_lti_launch_lecture(
    $instance->remoteuuid,
    $role,
    $USER->id,
    $course->id,
    $instance->name,
    $instance->intro
);

echo $content;
