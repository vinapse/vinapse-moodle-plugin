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

/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */
/** @var core_user $USER */

$destinationpath = required_param('to', PARAM_URL);

// Require login but don't auto-login guests
require_login(null, false);

// However if the user is already logged in as a guest, show a page to force them to login (again)
if (isguestuser()) {
    $PAGE->set_pagelayout('standard');
    $PAGE->set_url('/mod/vinapse/launch.php', array('to' => $destinationpath));
    $PAGE->set_title(get_string('modulename', 'mod_vinapse'));
    $PAGE->set_heading(get_string('modulename', 'mod_vinapse'));

    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('launch_guest_title', 'mod_vinapse'));

    notice(get_string('launch_guest_description', 'mod_vinapse'), get_login_url());
} else {
    $content = lti_helper::request_lti_launch_generic($destinationpath);
    echo $content;
}
