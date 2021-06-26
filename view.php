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
 * Prints an instance of mod_daddyvideo.
 *
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');
require_once(__DIR__ . '/output/video_page.php');

// Get course module ID
$cmid = required_param('id', PARAM_INT);

// Get course and course module records
list ($course, $cm) = get_course_and_cm_from_cmid($cmid, 'daddyvideo');

// Get the module instance from its own table
$moduleinstance = $DB->get_record('daddyvideo', array('id' => $cm->instance), '*', MUST_EXIST);

// Check that the user can see this course module
require_login($course, true, $cm);

$PAGE->set_url('/mod/daddyvideo/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($moduleinstance->name));
$PAGE->set_heading(format_string($course->fullname));

echo $OUTPUT->header();

$renderable = new \mod_daddyvideo\output\video_page($cmid, $moduleinstance->name);
echo $OUTPUT->render($renderable);

echo $OUTPUT->footer();
