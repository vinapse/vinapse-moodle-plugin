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
 * Display information about all the mod_daddyvideo modules in the requested course.
 *
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');

/** @var moodle_database $DB */
/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */

$id = required_param('id', PARAM_INT);

$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
require_course_login($course);

$coursecontext = context_course::instance($course->id);

$PAGE->set_url('/mod/daddyvideo/index.php', array('id' => $id));
$PAGE->set_title(format_string($course->fullname));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($coursecontext);

echo $OUTPUT->header();

$modulenameplural = get_string('modulenameplural', 'mod_daddyvideo');
echo $OUTPUT->heading($modulenameplural);

$daddyvideos = get_all_instances_in_course('daddyvideo', $course);

if (empty($daddyvideos)) {
    notice(get_string('noresources', 'mod_daddyvideo'), new moodle_url('/course/view.php', array('id' => $course->id)));
}

$table = new html_table();
$table->attributes['class'] = 'generaltable mod_index';

if ($course->format == 'weeks') {
    $table->head = array(get_string('week'), get_string('name'), get_string('moduleintro'));
    $table->align = array('center', 'left', 'left');
} else if ($course->format == 'topics') {
    $table->head = array(get_string('topic'), get_string('name'), get_string('moduleintro'));
    $table->align = array('center', 'left', 'left');
} else {
    $table->head = array(get_string('name'), get_string('moduleintro'));
    $table->align = array('left', 'left');
}

foreach ($daddyvideos as $daddyvideo) {
    if (!$daddyvideo->visible) {
        $link = html_writer::link(
            new moodle_url('/mod/daddyvideo/view.php', array('id' => $daddyvideo->coursemodule)),
            format_string($daddyvideo->name, true),
            array('class' => 'dimmed'));
    } else {
        $link = html_writer::link(
            new moodle_url('/mod/daddyvideo/view.php', array('id' => $daddyvideo->coursemodule)),
            format_string($daddyvideo->name, true));
    }

    $intro = format_module_intro('daddyvideo', $daddyvideo, $daddyvideo->coursemodule);

    if ($course->format == 'weeks' or $course->format == 'topics') {
        $table->data[] = array($daddyvideo->section, $link, $intro);
    } else {
        $table->data[] = array($link, $intro);
    }
}

echo html_writer::table($table);
echo $OUTPUT->footer();
