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
 * Plugin strings are defined here.
 *
 * @package     mod_daddyvideo
 * @category    string
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'DADdy video';
$string['modulename'] = 'DADdy video';
$string['modulenameplural'] = 'DADdy video';
$string['modulename_help'] = 'The DADdy video module enables a teacher to upload a video file of a lecture, making it available to students through an advanced video player.

Once the resource is created, you will be given the possibility to upload a video file and fill some additional information about the lecture. The video will then be processed in a few minutes. 

The video player consists of advanced features to aid the student in the fruition of the lecture, e.g. automatic slides detection, sections extraction, keywords extraction, turbo mode, etc.';
$string['daddyvideoname'] = 'Title';
$string['pluginadministration'] = 'DADdy video plugin administration';
$string['noresources'] = 'No video resources found in this course.';

$string['form_remoteuuid'] = 'Remote UUID';
$string['form_gotoupload'] = 'Create and go to video upload';
$string['form_uploadhint_label'] = 'Video upload';
$string['form_uploadhint_text'] = 'To upload the video file, proceed by saving the resource. You will then be able to do the upload.';

$string['daddyvideo:addinstance'] = 'Add video resource';

$string['setting_lti_provider_url'] = 'LTI provider URL';
$string['setting_lti_provider_url_desc'] = 'The base URL of the LTI provider that was provided to you.';
$string['setting_lti_key'] = 'LTI key';
$string['setting_lti_key_desc'] = 'The LTI key that was provided to you.';
$string['setting_lti_secret'] = 'LTI secret';
$string['setting_lti_secret_desc'] = 'The LTI secret that was provided to you.';

$string['error_popup_title'] = 'Error';
$string['error_popup_message'] = 'There was an unexpected error while preparing the upload. Please refresh the page and start again.';
$string['error_popup_button'] = 'Refresh';

$string['error_not_configured'] = 'Missing LTI provider URL. Please contact support.';

$string['launch_title'] = 'Authentication required';
$string['launch_description'] = 'Guests are not allowed to access the platform. Please login.';
