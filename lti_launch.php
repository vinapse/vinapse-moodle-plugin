<?php

/**
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_daddyvideo\lti_helper;

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

require_login();

// TODO: verify the user can access the resource (?)

/** @var moodle_database $DB */
/** @var core_user $USER */

// Read the course module ID
$cmid = required_param('cmid', PARAM_INT);

// Load the course, course module, and module instance from its own table
list ($course, $cm) = get_course_and_cm_from_cmid($cmid, 'daddyvideo');
$moduleinstance = $DB->get_record('daddyvideo', array('id' => $cm->instance), '*', MUST_EXIST);

// Check whether the current user has the capability to edit module instances
$canedit = has_capability('mod/daddyvideo:addinstance', context_course::instance($course->id));
$role = $canedit ? 'Instructor' : 'Learner';

// Take off
$content = lti_helper::daddy_request_lti_launch(
    $moduleinstance->remoteuuid,
    $role,
    $USER->id,
    $course->id,
    $moduleinstance->name,
    $moduleinstance->intro
);

echo $content;
