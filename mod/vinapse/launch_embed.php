<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <https://www.gnu.org/licenses/>.

/**
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_vinapse\lti_helper;

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

/** @var moodle_database $DB */
/** @var core_user $USER */

// Read the course module ID
$cmid = required_param('cmid', PARAM_INT);

// Load the course and course module
list ($course, $cm) = get_course_and_cm_from_cmid($cmid, 'vinapse');

// Verify that the user can see this course module. The user might be a guest!
require_login($course, true, $cm);

// Load module instance from its own table
$instance = $DB->get_record('vinapse', array('id' => $cm->instance), '*', MUST_EXIST);

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
