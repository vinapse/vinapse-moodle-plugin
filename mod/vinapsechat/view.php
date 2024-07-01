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
 * @package     mod_vinapsechat
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__ . '/../../config.php');

/** @var moodle_database $DB */
/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */

// Get course module ID
$cmid = required_param('id', PARAM_INT);
$query = optional_param('query', '', PARAM_TEXT);

// Get course and course module records
list ($course, $cm) = get_course_and_cm_from_cmid($cmid, 'vinapsechat');

// Verify that the user can see this course module, don't auto-login guests
require_login($course, false, $cm);

// Guests cannot access the chat
if (isguestuser()) {
    $PAGE->set_pagelayout('standard');
    $PAGE->set_url('/mod/vinapsechat/view.php', array('id' => $cmid));
    $PAGE->set_title(get_string('modulename', 'mod_vinapsechat'));
    $PAGE->set_heading(get_string('modulename', 'mod_vinapsechat'));

    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('launch_guest_title', 'mod_vinapsechat'));

    notice(get_string('launch_guest_description', 'mod_vinapsechat'), get_login_url());

    echo $OUTPUT->footer();
}
else {
    // Get the module instance from its own table
    $instance = $DB->get_record('vinapsechat', array('id' => $cm->instance), '*', MUST_EXIST);

    $PAGE->set_url('/mod/vinapsechat/view.php', array('id' => $cmid));
    $PAGE->set_title($instance->name);
    $PAGE->set_heading($course->fullname);

    // Get the hostname of the LTI provider URL and pass it to the JavaScript module
    $lti_endpoint = get_config('mod_vinapse', 'lti_provider_base_url');
    $lti_hostname = parse_url($lti_endpoint, PHP_URL_HOST);

    $PAGE->requires->js_call_amd('mod_vinapse/view', 'init', array('cmid' => $cmid, 'lti_host' => $lti_hostname));

    echo $OUTPUT->header();

    echo $OUTPUT->render_from_template('mod_vinapsechat/chat_page', [
        'launch_url' => (new moodle_url(
            '/mod/vinapsechat/launch.php',
            [
                'cmid' => $cmid,
                'query' => $query,
            ]
        ))->out(false)
    ]);

    echo $OUTPUT->footer();
}
