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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Prints an instance of mod_vinapse.
 *
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_vinapse\output\video_page;

require(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/output/video_page.php');

/** @var moodle_database $DB */
/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */

// Get course module ID
$cmid = required_param('id', PARAM_INT);

// Get course and course module records
list ($course, $cm) = get_course_and_cm_from_cmid($cmid, 'vinapse');

// Get the module instance from its own table
$instance = $DB->get_record('vinapse', array('id' => $cm->instance), '*', MUST_EXIST);

// Verify that the user can see this course module
require_login($course, true, $cm);

// Mark activity as completed/viewed
$completion = new completion_info($course);
$completion->set_module_viewed($cm);

$PAGE->set_url('/mod/vinapse/view.php', array('id' => $cmid));
$PAGE->set_title($instance->name);
$PAGE->set_heading($course->fullname);

// Get the hostname of the LTI provider URL and pass it to the JavaScript module
$lti_endpoint = get_config('mod_vinapse', 'lti_provider_base_url');
$lti_hostname = parse_url($lti_endpoint, PHP_URL_HOST);

$PAGE->requires->js_call_amd('mod_vinapse/view', 'init', array('cmid' => $cmid, 'lti_host' => $lti_hostname));

echo $OUTPUT->header();

$renderable = new video_page($cmid);
echo $OUTPUT->render($renderable);

echo $OUTPUT->footer();
