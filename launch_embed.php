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

// Read the course module ID
$cmid = required_param('cmid', PARAM_INT);

// Load the course and course module
list ($course, $cm) = get_course_and_cm_from_cmid($cmid, 'daddyvideo');

// Verify that the user can see this course module. The user might be a guest!
require_login($course, true, $cm);

// Load module instance from its own table
$instance = $DB->get_record('daddyvideo', array('id' => $cm->instance), '*', MUST_EXIST);

// Take off
$content = lti_helper::request_lti_launch_lecture(
    $instance->remoteuuid ?? '',
    $course->id,
    $course->shortname,
    $course->fullname,
    $instance->name,
    $instance->intro
);

echo $content;
